<?php


namespace App\Repository\Products;

use App\Interfaces\Products\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductRepository implements ProductRepositoryInterface
{
    public function index()
    {

        $products = Product::paginate(10);

        return view('dashboard.Products.index', compact('products'));
    }
    public function create()
    {
        //
    }
    public function store($request)
    {
        //
    }
    public function edit($id)
    {

        $product = Product::findOrFail($id);
    }
    public function update($request)
    {
        //
    }
    public function destroy($request)
    {
        //
    }
}
