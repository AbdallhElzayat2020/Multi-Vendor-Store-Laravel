<?php

namespace App\Repository\Cart;

use App\Interfaces\Cart\CartRepositoryInterface;
use App\Models\Product;

class CartRepository implements CartRepositoryInterface
{

    public function get()
    {
        // TODO: Implement get() method.
    }

    public function add(Product $product, $quantity = 1)
    {
        // TODO: Implement add() method.
    }

    public function update(Product $product, $quantity)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function empty()
    {
        // TODO: Implement empty() method.
    }

    public function total()
    {
        // TODO: Implement total() method.
    }
}
