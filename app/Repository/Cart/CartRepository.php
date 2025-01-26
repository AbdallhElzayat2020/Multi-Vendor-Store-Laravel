<?php

namespace App\Repository\Cart;

use App\Interfaces\Cart\CartRepositoryInterface;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartRepository implements CartRepositoryInterface
{

    protected $items;

    public function __construct()
    {
        //collect method is used to convert array to a collection
        $this->items = collect([]);
    }

    public function get()
    {
        if (!$this->items->count()) {
            $this->items = Cart::with('product')->get();
        }
        return $this->items;
    }

    public function add(Product $product, $quantity = 1)
    {
        $item = Cart::where('product_id', '=', $product->id)->first();
        if (!$item) {
            $cart = Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
            $this->get()->push($cart);
        } else {
            $item->increment('quantity', $quantity);
        }
    }

    public function update($id, $quantity)
    {
        Cart::where('id', '=', $id)
            ->update([
                'quantity' => $quantity
            ]);
    }

    public function delete($id)
    {
        Cart::where('id', '=', $id)->delete();
    }

    public function empty()
    {
        Cart::query()->delete();
    }

    public function total(): float
    {
        // sql join but it is not efficient
        /*  return (float)Cart::join('products', 'products.id', '=', 'carts.product_id')
              ->selectRaw('sum(products.price * carts.quantity) as total')
              ->value('total');
        */

        return $this->get()->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
    }
}
