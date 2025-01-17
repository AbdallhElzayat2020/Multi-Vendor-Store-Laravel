<?php

namespace App\Repository\Cart;

use App\Interfaces\Cart\CartRepositoryInterface;
use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartRepository implements CartRepositoryInterface
{

    // create Cookie
    protected function getCookieId()
    {
        $cookie_id = Cookie::get('cart_id');
        if (!$cookie_id) {
            $cookie_id = Str::uuid();
            Cookie::queue('cart_id', $cookie_id, 30 * 24 * 60);
        }
        return $cookie_id;
    }

    // get Cart
    public function get()
    {
        $items = Cart::with('product')->where('cookie_id', '=', $this->getCookieId())->get();

        return view('front.cart.index', compact('items'));
    }

    // add to Cart
    public function add(Product $product, $quantity = 1)
    {
        $item = Cart::where('cookie_id', '=', $this->getCookieId())
            ->where('product_id', '=', $product->id)
            ->first();

        if (!$item) {
            Cart::create([
                'cookie_id' => $this->getCookieId(),
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        $item->increment('quantity', $quantity);


        return redirect()->route('cart.index');
    }

    // update Cart
    public function update(Product $product, $quantity)
    {
        Cart::where('product_id', '=', $product->id)
            ->where('cookie_id', '=', $this->getCookieId())
            ->update([
                'quantity' => $quantity,
            ]);
    }

    // delete Cart
    public function delete($id)
    {
        Cart::where('id', $id)
            ->where('cookie_id', '=', $this->getCookieId())
            ->delete();
    }

    // empty Cart
    public function empty()
    {
        Cart::where('cookie_id', '=', $this->getCookieId())->delete();
    }

    // total Cart
    public function total()
    {
        return Cart::where('cookie_id', '=', $this->getCookieId())->sum('quantity');
    }
}
