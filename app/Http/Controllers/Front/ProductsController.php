<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductsController extends Controller
{
    //

    public function index()
    {
        //
    }

    public function show(Product $product)
    {
        if ($product->status !== 'active') {
            abort(404);
        }

        return view('front.Products.show', compact('product'));
    }
}
