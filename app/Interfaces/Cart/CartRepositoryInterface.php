<?php

namespace App\Interfaces\Cart;

use App\Models\Product;

interface CartRepositoryInterface
{
    public function get();

    public function add(Product $product, $quantity = 1);

    public function update($id, $quantity);

    public function delete($id);

    public function empty();

    public function total(): float;
}
