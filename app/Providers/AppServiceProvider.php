<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;//preventLazyLoading
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Gate; 
use App\Models\User;

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
        Model::preventLazyLoading();
        Schema::defaultStringLength(191);

        Gate::define('be-admin', function (User $user) {
            return $user->roles->contains('role', 'admin');
        });
        Gate::define('be-seller', function (User $user) {
            return $user->roles->contains('role', 'seller') || $user->roles->contains('role', 'admin');
        });
        Gate::define('be-moder', function (User $user) {
            return $user->roles->contains('role', 'moder') || $user->roles->contains('role', 'admin');
        });
    }
}
