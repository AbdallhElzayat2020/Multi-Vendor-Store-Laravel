<?php

namespace App\Interfaces\Categories;

use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function index($request);
    public function create();
    public function store($request);
    public function show(Category $category);
    public function edit($id);
    public function update($request, $id);
    public function destroy($id);
    public function trash();
    public function restore($id);
    public function forceDelete($id);
}
