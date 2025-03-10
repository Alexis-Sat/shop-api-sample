<?php

namespace App\Providers;

use App\Interfaces\GoodRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Repositories\GoodRepository;
use App\Repositories\OrderRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(GoodRepositoryInterface::class, GoodRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
