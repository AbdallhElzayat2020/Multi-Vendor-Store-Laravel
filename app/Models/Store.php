<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    // IF I want to change the created_at and updated_at
    // const CREATED_AT = 'created_on';
    // const UPDATED_AT = 'updated_on';

    // if I Have a multi connection database
    // protected $connection = 'mysql';

    // if I want to change the primary key
    // protected $primaryKey = 'id';

    // if I want to change the auto incrementing
    // public $incrementing = false , true;

    // if I want to change the timestamps
    // protected $timestamps = true , false;

    protected $table = 'stores';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo_image',
        'cover_image',
        'status',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'store_id', 'id');
    }
}
