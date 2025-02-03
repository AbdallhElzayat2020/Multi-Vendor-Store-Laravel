<?php

namespace App\Listeners;

use App\Events\OrderCreate;
use App\Facades\Cart;
use App\Models\Product;
use DB;

class DeductProductQuantity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

//    public function handle()
//    {
//        foreach (Cart::get() as $item) {
//            $product = Product::where('id', '=', $item->product_id)->first();
//            $newQuantity = max(0, $product->quantity - $item->quantity);
//            $product->update([
//                'quantity' => $newQuantity,
//            ]);
//        }
//    }
    public function handle(OrderCreate $event)
    {
        $order = $event->order;

        foreach ($order->products as $product) {
            //order item is a name from the pivot table in Order model
            $product->decrement('quantity', $product->order_item->quantity); // Decrement the quantity of the product

//            Product::where('id', '=', $item->product_id)
//                ->update([
//                    'quantity' => DB::raw('quantity - ' . $item->quantity),
//                ]);
        }
    }
}
