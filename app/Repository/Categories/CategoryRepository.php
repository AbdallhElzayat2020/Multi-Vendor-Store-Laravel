<?php

namespace App\Repository\Categories;

use App\Interfaces\Categories\CategoryRepositoryInterface;
use App\Models\Category;
use Exception;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryRepository implements CategoryRepositoryInterface
{



    public function index($request)
    {
        $query = Category::query();

        // $name = $request->query('name');
        if ($name = $request->query('name')) {
            $query->where('name', 'LIKE', "%{$name}%");
        }

        // $status = $request->query('status');
        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }

        $categories = $query->paginate(2);  // return Collection
        // $categories = DB::table('categories')->get();
        return view('dashboard.Categories.index', compact('categories'));
    }
    public function create()
    {
        $parents = Category::all();
        $category = new Category(); // for create category face;
        return view('dashboard.Categories.create', compact('parents', 'category'));
    }
    public function store($request)
    {

        // Category::create($request->all());

        try {
            $request->merge([
                'slug' => Str::slug($request->name)
            ]);

            $data = $request->except('image');

            if ($request->hasFile('image')) {

                $file = $request->file('image');

                $path = $file->store('uploads', 'public');

                $request->merge([

                    $data['image'] = $path
                ]);
            }

            Category::create($data);

            //
        } catch (Exception $th) {

            return redirect()->route('dashboard.categories.index')->with('error', $th->getMessage());
        }
        return redirect()->route('dashboard.categories.index')->with('success', 'Category created successfully');
    }
    public function edit($id)
    {

        try {
            $category = Category::findOrFail($id);

            // we make that category id is not the same because not logic make category Parent for itself

            $parents = Category::where('id', '!=', $category->id)
                ->where(function ($query) use ($id) {
                    $query->whereNull('parent_id')
                        ->orWhere('parent_id', '!=', $id);
                })
                ->get();

            return view('dashboard.Categories.edit', compact('category', 'parents'));
        } catch (Exception $e) {
            return redirect()->route('dashboard.categories.index')->with('error', $e->getMessage());
        }
    }
    public function update($request, $id)
    {
        try {
            $category = Category::findOrFail($id);


            $old_image = $category->image;
            // check if the request has image
            $request->merge([
                'slug' => Str::slug($request->name)
            ]);

            $data = $request->except('image');

            if ($request->hasFile('image')) {

                $file = $request->file('image');

                $path = $file->store('uploads', 'public');

                $request->merge([

                    $data['image'] = $path
                ]);
            }

            $category->update($data);


            if ($old_image && $request->hasFile('image')) {

                Storage::disk('public')->delete($old_image);
            }

            $category->save();

            return redirect()->route('dashboard.categories.index')->with('success', 'Category updated successfully');
        } catch (Exception $e) {
            return redirect()->route('dashboard.categories.index')->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {

        try {
            $category = Category::findOrFail($id);
            $category->delete();

            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            return redirect()->route('dashboard.categories.index')->with('success', 'Category deleted successfully');
        } catch (Exception $e) {
            return redirect()->route('dashboard.categories.index')->with('error', $e->getMessage());
        }
    }
}
