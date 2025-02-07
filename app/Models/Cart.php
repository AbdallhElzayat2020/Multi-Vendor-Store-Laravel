<?php

namespace App\Models;

use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = [
        "cookie_id", "user_id", "product_id", "quantity", "options"
    ];

    public $incrementing = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public static function booted()
    {
        static::observe(CartObserver::class);
    }






    /*
     * multi auth
     * اللينك  يعنهي لو احد اخدو كوبي يبقي اللينك لو انا رفعت صورة جديدة يبقي نفس اللينك
     * كام واحد فاتح اللينك او شغل اللينك
     * ال ip بتاع الجهاز
     * لما اديك اللينك يبقي fullscreen  و autoplay
     *
    */


}
