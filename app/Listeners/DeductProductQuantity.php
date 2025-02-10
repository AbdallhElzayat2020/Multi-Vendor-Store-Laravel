<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Facades\Cart;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class DeductProductQuantity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle($event)
    {
//        $products = Cart::get();
//        foreach ($products as $product) {
//
//        }
//        dd($order->products);

        $order = $event->order;

        foreach ($order->products as $product) {

            $product->decrement('quantity', $product->order_item->quantity);

        }
    }
}
