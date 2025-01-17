<?php

namespace App\Models;

use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cart extends Model
{

    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'cookie_id',
        'product_id',
        'quantity',
        'options',
    ];

    // observer
    public static function booted()
    {
        static::observe(CartObserver::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'name' => 'Guest',
        ]);
    }
}
