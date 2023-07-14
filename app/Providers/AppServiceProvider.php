<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
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
        $cart = [
            'items' => [],
            'total' => 0.00,
            'vat' => 0.00,
            'discount' => 0.00,
            'sub_total' => 0.00,
            'grand_total' => 0.00,
            'count' => 0,
        ];
        Paginator::useBootstrapFive();
        session(['cart' => $cart]);
    }
}
