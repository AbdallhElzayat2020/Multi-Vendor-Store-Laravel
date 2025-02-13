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
     * @throws \Throwable
     */
    public function handle($event)
    {
//        foreach (Cart::get() as $product) {
//            Product::where('id', $product->id)->update([
//                'quantity' => DB::raw("quantity - {$product->quantity}"),
//            ]);
//        }

        $order = $event->order;

        try {
            foreach ($order->products as $product) {
                $product->decrement('quantity', $product->order_item->quantity);
            }
        } catch (\Throwable $e) {
            throw  $e;
        }
    }
}
