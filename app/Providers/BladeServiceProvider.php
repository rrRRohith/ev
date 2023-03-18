<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Models\User;

class BladeServiceProvider extends ServiceProvider{
    /**
     * Register services.
     */
    public function register(): void{
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void{
        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->hasRole(User::ADMIN_ROLE);
        });
    }
}
