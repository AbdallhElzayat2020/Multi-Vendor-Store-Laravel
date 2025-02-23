<?php

namespace App\Repository\Products;

use App\Interfaces\Products\ProductRepositoryInterface;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Support\Str;

class ProductRepository implements ProductRepositoryInterface
{
    public function index()
    {
        $products = Product::with(['store', 'category'])->paginate(10);

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

        $tags = implode(',', $product->tags()->pluck('name')->toArray());
        // dd($tags);

        return view('dashboard.Products.edit', compact('product', 'tags'));
    }

    public function update($request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->except('tags'));

        $tags = explode(',', $request->tags);

        $tag_ids = [];

        foreach ($tags as $t_name) {
            $slug = Str::slug($t_name);
            $tag = Tag::where('slug', $slug)->first();

            if (!$tag) {
                $tag = Tag::create([
                    'name' => $t_name,
                    'slug' => $slug,
                ]);
            }
            $tag_ids[] = $tag->id;
        }

        $product->tags()->sync($tag_ids);

        return redirect()->route('dashboard.products.index')
            ->with('success', 'Product Updated Successfully');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('dashboard.products.index')
            ->with('success', 'Product Deleted Successfully');
    }
}
