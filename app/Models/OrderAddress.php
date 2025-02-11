<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Symfony\Component\Intl\Countries;

class OrderAddress extends Model
{
    use HasFactory;

    protected $table = 'order_addresses';

    // fillable
    protected $fillable = [
        'order_id',
        'type',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'street_address',
        'city',
        'postal_code',
        'country',
        'state',
    ];

    // relations
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    // accessors
    public function getNameAttribute(): string
    {
        return $this->first_name . '' . $this->last_name;
    }

//    public function getCountryNameAttribute(): string
//    {
//        return Countries::getName($this->country);
//    }
}
