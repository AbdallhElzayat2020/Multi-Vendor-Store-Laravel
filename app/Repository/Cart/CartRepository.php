<?php

namespace App\Repository\Cart;

use App\Interfaces\Cart\CartRepositoryInterface;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class CartRepository implements CartRepositoryInterface
{

    protected $items;

    public function __construct()
    {
        $this->items = collect([]);
    }

    public function get()
    {
        if ($this->items->isEmpty()) {
            $this->items = Cart::with('product')->get();
        }
        return $this->items;
    }

    public function add(Product $product, $quantity = 1)
    {

        $item = Cart::where('product_id', '=', $product->id)->first();

        if (!$item) {
            return $cart = Cart::create([
                'user_id' => Auth::id(),
                'quantity' => $quantity,
                'product_id' => $product->id,
            ]);
            $this->get()->push($cart);
        }

        $item->increment('quantity', $quantity);

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
        Cart::where('id', '=', $id)
            ->delete();
    }

    public function empty()
    {
        Cart::query()->delete();
    }

    public function total(): float
    {
        return $this->get()->sum(function (Cart $cart) {
            return $cart->product->price * $cart->quantity;
        });
    }
}
