<?php

namespace App\Interfaces\Cart;

use App\Models\Product;
use Illuminate\Support\Collection;

interface CartRepositoryInterface
{

    public function get();

    public function add(Product $product, $quantity);

    public function update($id, $quantity);

    public function delete($id);

    public function empty();

    public function total(): float;


}
