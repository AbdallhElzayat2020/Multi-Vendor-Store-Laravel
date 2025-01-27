<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'user_id',
        'payment_method',
        'status',
        'payment_status',
    ];


    // Relationships
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Guest User',
        ]);
    }

    //order has many products
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id')
            ->using(OrderItem::class)
            ->withPivot('quantity', 'price', 'options', 'product_name');
    }

    public function addresses()
    {
        return $this->hasMany(OrderAddress::class);
    }

    public function billingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')
            ->where('type', 'billing');
    }

    public function shippingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')
            ->where('type', 'shipping');
    }

    protected static function booted()
    {
        static::creating(function (Order $order) {
            $order->number = Order::getNextOrderNumber();
        });
    }


    public static function getNextOrderNumber()
    {
        $year = Carbon::now()->year;
        $number = Order::whereYear('created_at', $year)->max('number');

        if ($number) {
            return $number + 1;
        }
        // number is year + 00001
        return $year . '00001';
    }
}
