<?php

namespace App\Http\Controllers\Dashboard\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Interfaces\Categories\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    protected $category;

    public function test()
    {

    }

    public function __construct(CategoryRepositoryInterface $category)
    {
        $this->category = $category;
    }

    public function index(Request $request)
    {
//        if (!Gate::allows('categories.view')) {
//            abort(403);
//        }
        return $this->category->index($request);
    }

    public function create()
    {
//        if (!Gate::allows('categories.create')) {
//            abort(403);
//        }
        return $this->category->create();
    }

    public function store(CategoryRequest $request)
    {
        return $this->category->store($request);
    }

    public function show(Category $category)
    {
        return $this->category->show($category);
    }

    public function edit($id)
    {
        return $this->category->edit($id);
    }

    public function update(CategoryRequest $request, $id)
    {
        return $this->category->update($request, $id);
    }

    public function trash()
    {
        return $this->category->trash();
    }

    public function destroy($id)
    {
        return $this->category->destroy($id);
    }

    public function restore($id)
    {
        return $this->category->restore($id);
    }

    public function forceDelete($id)
    {
        return $this->category->forceDelete($id);
    }
}
