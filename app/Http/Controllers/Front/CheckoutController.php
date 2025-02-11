<?php

namespace App\Http\Controllers\Front;

use App\Events\OrderCreated;
use App\Events\Test;
use App\Facades\Cart;
use App\Http\Controllers\Controller;
use App\Interfaces\Cart\CartRepositoryInterface;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Intl\Countries;

class CheckoutController extends Controller
{

    public function create(CartRepositoryInterface $cart)
    {

        if ($cart->get()->count() === 0) {
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
        $request->validate([
            'addr.billing.first_name' => ['required', 'string', 'max:255'],
            'addr.billing.last_name' => ['required', 'string', 'max:255'],
            'addr.billing.email' => ['nullable', 'email', 'max:255'],
            'addr.billing.phone_number' => ['required', 'max:255'],
        ]);
//0597894561
        $items = $cart->get()->groupBy('product.store_id')->all();

        DB::beginTransaction();

        try {
            foreach ($items as $store_id => $cart_items) {

                $order = Order::create([
                    'user_id' => auth()->id(),
                    'store_id' => $store_id,
                    'payment_method' => 'Cash On Delivery'
                ]);

                foreach ($cart_items as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product->id,
                        'product_name' => $item->product->name,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity,
                    ]);
                }

                foreach ($request->post('addr') as $type => $address) {
                    $address['type'] = $type;
                    $order->addresses()->create($address);
                }

                DB::commit();

                //event('order.created', $order, Auth::user());

                //event for DeductProductQuantity && Empty Cart
                event(new OrderCreated($order));
            }

        } catch (\Throwable $e) {
            DB::rollBack();
            dd($e);
        }
//        return redirect()->route('home');
    }
}
