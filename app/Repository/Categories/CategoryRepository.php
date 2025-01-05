<?php

namespace App\Repository\Categories;

use App\Interfaces\Categories\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryRepository implements CategoryRepositoryInterface
{



    public function index()
    {
        $categories = Category::paginate(10);  // return Collection
        // $categories = DB::table('categories')->get();
        return view('dashboard.Categories.index', compact('categories'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.Categories.create', compact('categories'));
    }
    public function store($request)
    {
        // Category::create($request->all());

        try {

            $request->merge([
                'slug' => Str::slug($request->name)
            ]);

            Category::create($request->all());

            //
        } catch (\Throwable $th) {

            return redirect()->route('dashboard.categories.index')->with('error', $th->getMessage());
        }

        //or
        // $category = new Category($request->all());
        // $category->slug = Str::slug($request->name);
        // $category->save();

        return redirect()->route('dashboard.categories.index')->with('success', 'Category created successfully');
    }
    public function edit($id)
    {

        $category = Category::findOrFail($id);

        // to make sure that the id is not the same because not logic make category Parent for itself

        $parents = Category::where('id', '!=', $category->id)->get();


        return view('dashboard.Categories.edit', compact('category', 'parents'));
    }
    public function update($request, $id)
    {
        $category = Category::findOrFail($id);
        // $request->merge([
        //     'slug' => Str::slug($request->name)
        // ]);
        // $category->update($request->all());


        $category->update($request->all());
        $category->slug = Str::slug($request->name);

        $category->save();

        return redirect()->route('dashboard.categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {

        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()->route('dashboard.categories.index')->with('success', 'Category deleted successfully');
    }
}
