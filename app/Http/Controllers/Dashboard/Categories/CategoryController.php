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

    public function edit($id)
    {
        return $this->category->edit($id);
    }

    public function update(Request $request, $id)
    {
        return  $this->category->update($request, $id);
    }

    public function destroy($id)
    {
        return  $this->category->destroy($id);
    }
}
