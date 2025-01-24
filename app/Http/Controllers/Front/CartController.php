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

        return view('front.cart.index', [
            'cart' => $this->cart,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);
        $quantity = $request->post('quantity');
        $product_id = $request->post('product_id');
        $product = Product::findOrFail($product_id);
        $this->cart->add($product, $quantity);

        return redirect()->route('cart.index')
            ->with('success', 'Product added to cart');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'quantity' => ['required', 'int', 'exists:products,id'],
            'product_id' => ['nullable', 'int', 'min:1'],
        ]);
        $quantity = $request->post('quantity');
        $product = Product::findOrFail($id);
        $this->cart->update($product, $quantity);
        return redirect()->route('cart.index')
            ->with('success', 'Product updated in cart');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->cart->delete($id);
    }
}
