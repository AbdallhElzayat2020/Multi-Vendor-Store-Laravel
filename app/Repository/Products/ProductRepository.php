<?php


namespace App\Repository\Products;

use App\Interfaces\Products\ProductRepositoryInterface;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
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

        // $request->validator([
        //     'name' => 'required|max:255|string|min:3',
        //     'slug' => 'required|string',
        //     'description' => 'nullable',
        //     'price' => 'numeric',
        //     'category_id' => 'required',
        //     'compare_price' => 'required|numeric|',
        //     'status' => 'in:active,draft,inactive'
        // ]);

        // $request->validate([
        //     'name' => 'required|max:255|string|min:3',
        //     'slug' => 'required|string',
        //     'description' => 'nullable',
        //     'price' => 'numeric',
        //     'category_id' => 'required',
        //     'compare_price' => 'required|numeric|',
        //     'status' => 'in:active,draft,inactive'
        // ]);

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
            };
            $tag_ids[] = $tag->id;
        }
        $product->tags()->sync($tag_ids);


        return redirect()->route('dashboard.products.index')
            ->with('success', 'Product Updated Successfully');
    }
    public function destroy($id)
    {
        //
    }
}
