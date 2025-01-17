<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Interfaces\Cart\CartRepositoryInterface;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    protected $cart;

    public function __construct(CartRepositoryInterface $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        return $this->cart->get();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validation
        $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['nullable', 'integer', 'min:1'],
        ]);

        //Get Data for request
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;

        return $this->cart->add($product, $quantity);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //Validation
        $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['nullable', 'integer', 'min:1'],
        ]);

        //Get Data for request
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;

        return $this->cart->update($product, $quantity);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->cart->delete($id);
    }
}
