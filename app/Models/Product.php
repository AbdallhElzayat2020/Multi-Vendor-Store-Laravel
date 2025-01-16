<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;



    //Global scope for check store Id
    protected static function booted()
    {
        static::addGlobalScope(StoreScope::class);
    }


    public function scopeActive(Builder $builder)
    {
        $builder->where('status', 'active');
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

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    // relationship for tags
    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'product_tag',
            'product_id',
            'tag_id'
        );
    }

    public function getImageDefaultAttribute()
    {
        return 'https://www.theseasonedhome.com/content/images/thumbs/default-image_450.png';

        // if (!$this->image) {
        //     return 'https://www.theseasonedhome.com/content/images/thumbs/default-image_450.png';
        // }
        // if (Str::startsWith($this->image, ['http://', 'https://'])) {
        //     return $this->image;
        // }
        // return asset('storage/' . $this->image);
    }
    public function getSalePercentAttribute()
    {
        if (!$this->compare_price) {
            return 0;
        }

        return round(100 - ($this->price / $this->compare_price) * 100, 2);
    }
}
