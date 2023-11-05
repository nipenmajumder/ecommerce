<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
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
//        Model::preventLazyLoading(! app()->isProduction());
//        Model::shouldBeStrict(! app()->isProduction());
//        Model::preventSilentlyDiscardingAttributes(! app()->isProduction());
//        if($this->app->environment(['production','staging'])) {
//            URL::forceScheme('https');
//        }
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
