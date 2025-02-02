<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    // scope
    public function scopeActive(Builder $builder)
    {
        $builder->where('status', '=', 'active');
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        // $builder->when($filters['name'] ?? false, function ($builder, $value) {
        //     $builder->where('name', 'LIKE', "%{$value}%");
        // });

        // $builder->when($filters['status'] ?? false, function ($builder, $value) {
        //     $builder->where('status', $value);
        // });

        // or
        if ($filters['name'] ?? false) {
            $builder->where('name', 'LIKE', "%{$filters['name']}%");
        }

        if ($filters['status'] ?? false) {
            $builder->where('status', $filters['status']);
        }
    }

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'status',
        'parent_id',
    ];

    // relationship Products on category
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // relationship for show Category Name
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id')
            ->withDefault([
                'name' => 'No Parent',
            ]);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}
