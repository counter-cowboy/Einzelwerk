<?php

namespace App\Providers;

use App\Models\Contragent;
use App\Policies\ContragentPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
$this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Contragent::class, ContragentPolicy::class);
    }
}
