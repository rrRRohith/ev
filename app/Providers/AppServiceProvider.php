<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider{
    /**
     * Register any application services.
     */
    public function register(): void{
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void{
        view()->share('request', request());
        view()->share('app', json_decode(json_encode([
            'name' => env('APP_NAME'),
            'map_key' => env('MAP_KEY')
        ])));
    }
}
