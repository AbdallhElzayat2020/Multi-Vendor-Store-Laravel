<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'store_id',
        'status',
        'payment_status',
        'payment_method',
    ];

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

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(OrderItem::class, 'order_items', 'order_id', 'product_id')
            ->using(OrderItem::class)
            ->as('order_item')
            ->withPivot('quantity', 'price', 'options', 'product_name');
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(OrderAddress::class);
    }

    public function billingAddress(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(OrderAddress::class)->where('type', 'billing');
    }

    public function shippingAddress(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(OrderAddress::class)->where('type', 'shipping');
    }

    public static function booted()
    {
        static::creating(static function (Order $order) {
            $order->number = Order::getNextOrderNumber();
        });
    }

    public static function getNextOrderNumber()
    {
        $year = Carbon::now()->year;
        $number = self::whereYear('created_at', $year)->max('number');

        if ($number) {
            return $number + 1;
        }
        return $year . '0001';
    }
}
