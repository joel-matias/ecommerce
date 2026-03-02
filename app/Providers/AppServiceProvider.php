<?php

namespace App\Providers;

use App\Models\Cover;
use App\Models\Order;
use App\Observers\CoverOserver;
use App\Observers\OrderObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Cover::observe(CoverOserver::class);
        Order::observe(OrderObserver::class);
    }
}
