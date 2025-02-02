<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    //

    public function index()
    {
        // $products = Product::Active()->limit(8)->get();
        $products = Product::with('category')
            ->Active()
            ->take(8)
            ->get();

        return view('front.home', compact('products'));
    }
}
