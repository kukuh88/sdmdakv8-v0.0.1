<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

        /**
     * Bootstrap any application sephp artisan vendor:publish --tag=publicrvices.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setlocale('id');
        Schema::defaultStringLength(191);

        Gate::define('update-post', function (User $user) {
            return $user->is_admin;
        });
    }
}
