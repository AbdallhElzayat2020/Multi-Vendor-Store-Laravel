<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Interfaces\Cart\CartRepositoryInterface;
use App\Models\Order;
use App\Models\OrderItem;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\Intl\Countries;
use Throwable;

class CheckoutController extends Controller
{
    public function create(CartRepositoryInterface $cart)
    {

        if ($cart->get()->count() == 0) {
            return redirect()->route('home');
        }

        $countries = Countries::getNames();
        return view('front.checkout.checkout', [
            'cart' => $cart,
            'countries' => $countries
        ]);
    }

    public function store(Request $request, CartRepositoryInterface $cart)
    {
        // $request->validate();
        // $items = Cart::products()->groupBy('store_id');
        $items = $cart->get()->groupBy('product.store_id')->all();
        foreach ($items as $store_id => $cart_items) {
            DB::beginTransaction();
            try {
                $order = Order::create([
                    'store_id' => $store_id,
                    'user_id' => auth()->id(),
                    'payment_method' => 'cash_on_delivery',
                ]);
                foreach ($cart_items as $item) {
                    // from cart
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product->id,
                        'product_name' => $item->product->name,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity
                    ]);
                };

                foreach ($request->post('addr') as $type => $address) {
                    $address['type'] = $type;
                    $order->addresses()->create($address);
                }
                $cart->empty();
                DB::commit();
                return redirect()->route('home', $order->id);
            } catch (Throwable $e) {
                DB::rollBack();
                dd($e);
            }
        }
    }
}
