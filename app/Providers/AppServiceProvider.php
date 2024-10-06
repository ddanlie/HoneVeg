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

        Gate::define('be-admin', function (User $user, $user_id=null) {
            $who = $user;
            if($user_id)
                $who = User::where('user_id', $user_id)->first();
            return $who->roles->contains('role', 'admin');
        });
        Gate::define('be-seller', function (User $user, $user_id=null) {
            $who = $user;
            if($user_id)
                $who = User::where('user_id', $user_id)->first();
            return $who->roles->contains('role', 'seller') || $user->roles->contains('role', 'admin');
        });
        Gate::define('be-moder', function (User $user, $user_id=null) {
            $who = $user;
            if($user_id)
                $who = User::where('user_id', $user_id)->first();
            return $who->roles->contains('role', 'moder') || $user->roles->contains('role', 'admin');
        });
        Gate::define('own-given-profile-id', function (User $user, $profile_id) {
            return $user->user_id === $profile_id;
        });
        Gate::define('sell-product', function (User $user, $product_id) {
            return $user->saleProducts()->where('product_id', $product_id)->exists();
        });
    }
}
