<?php

namespace App\Models;

use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cart extends Model
{

    use HasFactory;

    // turn off increment id
    public $incrementing = false;

    // fillable
    protected $fillable = [
        'user_id',
        'cookie_id',
        'product_id',
        'quantity',
        'options',
    ];

    // observer for Cart
    public static function booted()
    {
        static::observe(CartObserver::class);
    }

    //relationship for user with Cart
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'name' => 'Anonymous',
        ]);
    }

    //relationship for product with Cart
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
