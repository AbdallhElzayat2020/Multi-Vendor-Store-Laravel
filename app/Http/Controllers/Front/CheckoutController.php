<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Interfaces\Cart\CartRepositoryInterface;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Intl\Countries;

class CheckoutController extends Controller
{
    public function create(CartRepositoryInterface $cart)
    {
//        check for empty cart
        if ($cart->get()->isEmpty()) {
            return redirect()->route('home');
        }
        $countries = Countries::getNames();
        return view('front.checkout.checkout', [
            'cart' => $cart,
            'countries' => $countries,
        ]);
    }

    public function store(Request $request, CartRepositoryInterface $cart)
    {
//        $request->validate();
        //for collect store ID and group by store
        $items = $cart->get()->groupBy('product.store_id')->all();

        DB::beginTransaction();
        try {
            foreach ($items as $store_id => $cart_items) {
                $order = Order::create([
                    'store_id' => $store_id,
                    'user_id' => auth()->id(),
                    'payment_method' => 'cash_on_delivery',
                ]);
                foreach ($cart_items as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->name,
                        'quantity' => $item->quantity,
                        'price' => $item->product->price,
                    ]);
                }
                foreach ($request->post('addr') as $type => $address) {
                    $address['type'] = $type;
                    $order->addresses()->create($address);
                }
                $cart->empty();
                DB::commit();
                return redirect()->route('home')->with('success', 'Order has been placed successfully');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }

    }
}
