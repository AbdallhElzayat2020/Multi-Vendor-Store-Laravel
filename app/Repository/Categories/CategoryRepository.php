<?php

namespace App\Repository\Categories;

use App\Interfaces\Categories\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryRepositoryInterface
{



    public function index()
    {
        $categories = Category::all();
        // $categories = DB::table('categories')->get();
        return view('dashboard.Categories.index', compact('categories'));
    }
    public function create()
    {
        return view('dashboard.Categories.create');
    }
    public function store($request)
    {
        //
    }
    public function edit($request)
    {
        //
    }
    public function update($request)
    {
        //
    }
    public function destroy($request)
    {
        //
    }
}
