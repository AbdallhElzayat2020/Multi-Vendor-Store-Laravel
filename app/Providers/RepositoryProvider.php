<?php

namespace App\Providers;

use App\Interfaces\Categories\CategoryRepositoryInterface;
use App\Interfaces\Products\ProductRepositoryInterface;
use App\Repository\Categories\CategoryRepository;
use App\Repository\Products\ProductRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
