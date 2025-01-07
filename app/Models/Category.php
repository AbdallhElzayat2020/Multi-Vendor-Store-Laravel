<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'status',
        'parent_id',
    ];

    // protected static function rules($id)
    // {
    //     return [
    //         'name' => 'required|string|min:3|max:255|unique:categories,name,' . $this->id,
    //         'description' => 'nullable|string',
    //         'status' => 'required|in:archived,active',
    //         'parent_id' => 'nullable|integer|exists:categories,id',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg|max:1048576|mimetypes:mimetypes:image/jpeg,image/png,image/gif',
    //     ];
    // }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
