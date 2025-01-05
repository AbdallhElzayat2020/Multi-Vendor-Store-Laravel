<?php

namespace App\Http\Controllers\Dashboard\Categories;

use App\Http\Controllers\Controller;
use App\Interfaces\Categories\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $category;




    public function __construct(CategoryRepositoryInterface $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        return $this->category->index();
    }

    public function create()
    {
        return $this->category->create();
    }

    public function store(Request $request)
    {
        return $this->category->store($request);
    }

    public function edit(Request $request)
    {
        return $this->category->edit($request);
    }

    public function update(Request $request)
    {
        return  $this->category->update($request);
    }

    public function destroy(Request $request)
    {
        return  $this->category->destroy($request);
    }
}
