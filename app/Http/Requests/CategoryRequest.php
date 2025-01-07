<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'name' => 'required|string|min:3|max:255|unique:categories,name,' . $this->route('dashboard.categories'),
            // 'name' => 'required|string|min:3|max:255|unique:categories,name,' . $this->route('id'),
            // 'description' => 'nullable|string,max:500',
            // 'status' => 'required|in:archived,active',
            // 'parent_id' => 'nullable|integer|exists:categories,id',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg|max:1048576|mimetypes:mimetypes:image/jpeg,image/png,image/gif',



            'name' => 'required|string|min:3|max:255|unique:categories,name,' . $this->route('category'),
            'description' => 'nullable|string|max:500',
            'status' => 'required|in:archived,active',
            'parent_id' => 'nullable|integer|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:1048576',
            // dimensions:min_width=100,min_height=100
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Category name is required',
            'name.string' => 'Category name must be string',
            'name.min' => 'Category name must be at least 3 characters',
            'name.max' => 'Category name must be at most 255 characters',
            'name.unique' => 'Category name must be unique',
            'description.string' => 'Category description must be string',
            'status.required' => 'Category status is required',
            'status.in' => 'Category status must be archived or active',
            'parent_id.integer' => 'Category parent id must be integer',
            'parent_id.exists' => 'Category parent id must be exists',
            'image.image' => 'Category image must be image',
            'image.mimes' => 'Category image must be jpeg, png, jpg',
            'image.max' => 'Category image must be at most 1048576',
            'image.mimetypes' => 'Category image must be jpeg, png, jpg',
        ];
    }
}
