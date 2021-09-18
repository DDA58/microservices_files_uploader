<?php

namespace App\Providers;

use App\Services\EventDispatcher\IEventDispatcher;
use App\Services\JobDispatcher\IJobDispatcher;
use App\Services\JobDispatcher\LaravelJobDispatcher;
use Illuminate\Support\ServiceProvider;
use App\Services\EventDispatcher\LaravelEventDispatcher;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IEventDispatcher::class, LaravelEventDispatcher::class);
        $this->app->bind(IJobDispatcher::class, LaravelJobDispatcher::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
