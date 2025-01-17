<?php

namespace App\Providers;

use App\Interfaces\Cart\CartRepositoryInterface;
use App\Interfaces\Categories\CategoryRepositoryInterface;
use App\Interfaces\Products\ProductRepositoryInterface;
use App\Interfaces\Profile\ProfileRepositoryInterface;
use App\Repository\Cart\CartRepository;
use App\Repository\Categories\CategoryRepository;
use App\Repository\Products\ProductRepository;
use App\Repository\Profile\ProfileRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ProfileRepositoryInterface::class, ProfileRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
