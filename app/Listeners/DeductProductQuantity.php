<?php

namespace App\Listeners;

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

    public function handle(): void
    {
        foreach (Cart::get() as $item) {
            // Product::where('id', '=', $item->product_id)->decrement('quantity', $item->quantity);

            Product::where('id', '=', $item->product_id)->update([
                'quantity' => DB::raw("quantity - {$item->quantity}"),
            ]);
        }
    }
}
