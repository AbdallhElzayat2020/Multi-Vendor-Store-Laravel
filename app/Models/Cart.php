<?php

namespace App\Models;

use App\Observers\CartObserver;
use Cookie;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'cookie_id',
        'user_id',
        'product_id',
        'quantity',
        'options',
    ];

    //Get Cookie Id
    public static function getCookieId()
    {
        $cookie_id = Cookie::get('cart_cookie');
        if (!$cookie_id) {
            $cookie_id = Str::uuid();
            Cookie::queue('cart_cookie', $cookie_id, 60 * 24 * 30);
        }
        return $cookie_id;
    }

    // Global scope for check cookie Id
    protected static function booted()
    {

        // for cart
        static::observe(CartObserver::class);

        //manual observer
        // static::creating(function (Cart $cart) {
        //     $cart->id = Str::uuid();
        // });

        // addGlobalScope for CookieId for cart
        static::addGlobalScope('cookie_id', function (Builder $builder) {
            $builder->where('cookie_id', self::getCookieId());
            // or
            // $builder->where('cookie_id', Cart::getCookieId());
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')
            ->withDefault([
                'name' => 'anonymous',
            ]);
    }
}
