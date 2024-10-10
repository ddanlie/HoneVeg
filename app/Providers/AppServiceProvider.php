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
            return $who->roles->contains('role', 'seller');
        });
        Gate::define('be-moder', function (User $user, $user_id=null) {
            $who = $user;
            if($user_id)
                $who = User::where('user_id', $user_id)->first();
            return $who->roles->contains('role', 'moderator');
        });
        Gate::define('own-given-profile-id', function (User $user, $profile_id) {
            return $user->user_id === $profile_id;
        });
        Gate::define('sell-product', function (User $user, $product_id) {
            return $user->saleProducts()->where('product_id', $product_id)->exists();
        });
        Gate::define('be-order-creator', function (User $user, $order_id) {
            return $user->createdOrders()->where('order_id', $order_id)->exists();
        });
        Gate::define('be-order-participant', function (User $user, $order_id) {
            return $user->sellerOrders()->where('seller_orders.order_id', $order_id)->exists();
        });
        Gate::define('be-design-author', function (User $user, $design_id) {
            return $user->createdCategoryDesigns()->where('design_id', $design_id)->exists();
        });
    }
}
