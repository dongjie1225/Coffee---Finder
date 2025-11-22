<?php

namespace App\Providers;

use App\Models\CoffeeShop;
use App\Policies\CoffeeShopPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        CoffeeShop::class => CoffeeShopPolicy::class,
    ];

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
        // Register policies
        Gate::policy(CoffeeShop::class, CoffeeShopPolicy::class);
    }
}
