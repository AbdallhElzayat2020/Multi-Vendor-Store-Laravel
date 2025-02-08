<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Interfaces\Cart\CartRepositoryInterface;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    protected $cart;

    public function __construct(CartRepositoryInterface $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Display a listing of the resource.
     */
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
            'product_id' => 'required|exists:products,id|int',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $product = Product::findOrFail($request->post('product_id'));
        $quantity = $request->post('quantity');

        $this->cart->add($product, $quantity);
        return redirect()->route('cart.index')
            ->with('success', 'Product added to cart');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->post('product_id'));
        $quantity = $request->post('quantity');
        $this->cart->update($product, $quantity);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->cart->delete($id);
    }
}
