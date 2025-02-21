<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
        return Product::with('category:id,name', 'store:id,name', 'tags')
            ->filter($request->query())
            ->paginate(10);


//        return response()->json([
//            'products' => $products,
//            'status' => 200,
//        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|gt:price',
            'status' => 'in:active,inactive',
        ]);

        $product = Product::create($request->all());

        return response()->json([
            'product' => $product,
            'message' => 'Product created successfully',
            'status' => 201,
        ]);
//        $product = Product::create([
//            'name' => $request->name,
//            'description' => $request->description,
//            'slug' => Str::slug($request->name),
//            'price' => $request->price,
//            'quantity' => $request->quantity,
//            'status' => $request->status,
//            'image' => $request->file('image')->store('products'),
//            'compare_price' => $request->compare_price,
//        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

        return $product->load('category:id,name', 'store:id,name', 'tags:id,name');
//        return Product::with('category:id,name', 'store:id,name', 'tags')->findOrFail($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string|max:255',
            'category_id' => 'sometimes|required|exists:categories,id',
            'status' => 'in:active,inactive',
            'price' => 'sometimes|required|numeric|min:0',
            'compare_price' => 'nullable|numeric|gt:price',
        ]);

        $product->update($request->all());

        return response()->json([
            'product' => $product,
            'message' => 'Product updated successfully',
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);
        return response()->json([
            'message' => 'Product deleted successfully',
        ], 200);
    }
}
