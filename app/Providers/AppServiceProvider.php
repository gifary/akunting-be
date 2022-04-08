<?php

namespace App\Providers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

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
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addDays(7));

        Passport::refreshTokensExpireIn(Carbon::now()->addDays(14));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
