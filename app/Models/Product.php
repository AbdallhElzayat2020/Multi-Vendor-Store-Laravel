<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;



    //Global scope for check store Id 
    protected static function booted()
    {
        static::addGlobalScope(StoreScope::class);
    }

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'compare_price',
        'options',
        'rating',
        'featured',
        'status',
        'image',
        'store_id',
        'category_id',
    ];
}
