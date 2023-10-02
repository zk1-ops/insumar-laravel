<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Laravel\Sanctum\Sanctum;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //

        Sanctum::ignoreMigrations(); // Disabilitamos el Sanctum al hacer migracion !
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
