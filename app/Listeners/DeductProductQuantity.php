<?php

namespace App\Listeners;

use App\Facades\Cart;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
    public function handle(): void
    {
//        $products = Cart::get();
//        foreach ($products as $product) {
//
//        }

        foreach (Cart::get() as $item) {
//            $item->product->decrement('quantity', $item->quantity);

            Product::where('id','=',$item->product_id)
                ->update([

                ]);
        }
    }
}
