<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'name' => 'Guest',
        ]);
    }

    public function store(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(OrderItem::class, 'order_items', 'order_id', 'product_id')
            ->using(OrderItem::class)
            ->withPivot(['quantity', 'price', 'options', 'product_name'])
            ->as('order_item');
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(OrderAddress::class, 'order_id');
    }

    public function billingAddress(): HasOne
    {
        return $this->hasOne(OrderAddress::class, 'order_id')->where('type', 'billing');
    }

    public function shippingAddress(): HasOne
    {
        return $this->hasOne(OrderAddress::class, 'order_id')->where('type', 'shipping');
    }

    public static function booted()
    {
        static::creating(function (Order $order) {

            $order->number = Order::getNextOrderNumber();
        });
    }

    public static function getNextOrderNumber()
    {
        $year = now()->year;
        $number = self::whereYear('created_at', now()->year)->max('number');
        if ($number) {
            return $number + 1;
        }

        return $year . '0001';
    }
}
