<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
        /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\IUsersRepository', 'App\Repositories\UsersRepositoryImpl');
        $this->app->bind('App\Interfaces\IProvidersRepository', 'App\Repositories\ProvidersRepositoryImpl');
        $this->app->bind('App\Interfaces\IProductsRepository', 'App\Repositories\ProductsRepositoryImpl');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->registerPolicies();
        Passport::routes();
    }
}
