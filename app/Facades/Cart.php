<?php

namespace App\Facades;

use App\Interfaces\Cart\CartRepositoryInterface;
use Illuminate\Support\Facades\Facade;

class Cart extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CartRepositoryInterface::class;
    }
}
