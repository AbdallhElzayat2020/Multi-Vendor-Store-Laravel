<?php

namespace App\Http\Controllers\Dashboard\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Interfaces\Categories\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $category;




    public function __construct(CategoryRepositoryInterface $category)
    {
        $this->category = $category;
    }

    public function index(Request $request)
    {
        return $this->category->index($request);
    }

    public function create()
    {
        return $this->category->create();
    }

    public function store(CategoryRequest $request)
    {
        return $this->category->store($request);
    }

    public function edit($id)
    {
        return $this->category->edit($id);
    }

    public function update(CategoryRequest $request, $id)
    {
        return  $this->category->update($request, $id);
    }

    public function destroy($id)
    {
        return  $this->category->destroy($id);
    }
}
