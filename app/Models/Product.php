<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;


class Product extends Model
{
    use HasFactory;

    // Global scope for check store Id
    protected static function booted()
    {
        static::addGlobalScope(StoreScope::class);

        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }

    protected $hidden = [
        'created_at',
        'updated_at',
        'image',
        'deleted_at',
    ];
    protected $appends = [
        'image_default',
    ];

//    scope for active products
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

    public function order(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_items', 'product_id', 'order_id');
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function store(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    // relationship for tags
    public function tags(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
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
//        return 'https://www.theseasonedhome.com/content/images/thumbs/default-image_450.png';

        if (!$this->image) {
            return 'https://www.theseasonedhome.com/content/images/thumbs/default-image_450.png';
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }

    public function getSalePercentAttribute(): float|int
    {
        if (!$this->compare_price) {
            return 0;
        }

        return round(100 - ($this->price / $this->compare_price) * 100, 2);
    }


//    public function FilterScope(Builder $builder,$filter): Builder
//    {
////        return $query->when(request('category'), function ($query) {
////            return $query->where('category_id', request('category'));
////        })->when(request('store'), function ($query) {
////            return $query->where('store_id', request('store'));
////        })->when(request('tag'), function ($query) {
////            return $query->whereHas('tags', function ($query) {
////                return $query->where('tag_id', request('tag'));
////            });
////        });
//
//    }


    public function scopeFilter(Builder $builder, $filter)
    {

        $options = array_merge([
            'store_id' => null,
            'category' => null,
            'tag_id' => null,
            'status' => 'active',
        ], $filter);

        $builder->when($options['status'], function ($query, $status) {
            return $query->where('status', $status);
        });

        $builder->when($options['store_id'], function ($builder, $value) {
            $builder->where('store_id', $value);
        });
        $builder->when($options['category'], function ($builder, $value) {
            $builder->where('category_id', $value);
        });

        $builder->when($options['tag_id'], function ($builder, $value) {

            $builder->whereExists(function ($query) use ($value) {
                $query->select(1)
                    ->from('product_tag')
                    ->whereRaw('product_id = products.id')
                    ->where('tag_id', $value);
            });
        });

//             $builder->whereRaw('id in (select product_id from product_tag where tag_id = ?)', [$value]);
//            $builder->whereRaw('EXISTS (select 1 from product_tag where product_tag.product_id = products.id and product_tag.tag_id = ?)', [$value]);

//            $builder->whereHas('tags', function ($builder) use ($value) {
//                $builder->whereIn('id', $value);
//            });

    }
}
