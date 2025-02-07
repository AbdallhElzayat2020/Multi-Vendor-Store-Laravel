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


    protected function getCookieId()
    {
        $cookieId = Cookie::get('cart_id');
        if (!$cookieId) {
            $cookieId = Str::uuid();
            Cookie::queue('cart_id', $cookieId, 60 * 24 * 30);
        }
        return $cookieId;
    }

    public function get()
    {
        return Cart::where('cookie_id', '=', $this->getCookieId())
            ->get();
    }

    public function add(Product $product, $quantity = 1)
    {
        return Cart::create([
            'user_id' => Auth::id(),
            'cookie_id' => $this->getCookieId(),
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);
    }

    public function update(Product $product, $quantity)
    {
        Cart::where('cookie_id', '=', $this->getCookieId())
            ->where('product_id', '=', $product->id)
            ->update([
                'quantity' => $quantity
            ]);
    }

    public function delete($id)
    {
        Cart::where('cookie_id', '=', $this->getCookieId())
            ->where('user_id', '=', Auth::id())
            ->where('id', '=', $id)
            ->delete();
    }

    public function empty()
    {
        Cart::where('cookie_id', '=', $this->getCookieId())
            ->delete();
    }

    public function total()
    {
        // TODO: Implement total() method.
    }

}
