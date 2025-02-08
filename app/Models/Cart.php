<?php

namespace App\Models;

use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $fillable = [
        'cookie_id', 'user_id', 'product_id', 'quantity', 'options'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'anonymous'
        ]);
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    //    Get CookieId
    public static function getCookieId()
    {
        $cookieId = Cookie::get('cart_id');
        if (!$cookieId) {
            $cookieId = Str::uuid();
            Cookie::queue('cart_id', $cookieId, 60 * 24 * 30);
        }
        return $cookieId;
    }


    protected static function booted()
    {
//        static::creating(function (Cart $cart) {
//            $cart->id = Str::uuid();
//        });
//
        static::observe(CartObserver::class);

//        global scope
        static::addGlobalScope('cookie_id', function (Builder $builder) {
            $builder->where('cookie_id', '=', self::getCookieId());
        });
    }

}

