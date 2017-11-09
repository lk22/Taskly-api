<?php

namespace Taskly\Providers;

use Illuminate\Support\ServiceProvider;


use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191); // set default length
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
