<?php

namespace App\Interfaces\Products;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function index();
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request, $id);
    public function destroy($id);
}
