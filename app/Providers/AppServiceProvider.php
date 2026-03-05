<?php

namespace App\Providers;

use App\Blueprint\LivewireGenerator;
use Blueprint\Blueprint;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

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
        $this->app->extend(Blueprint::class, function ($blueprint, $app) {
            $blueprint->registerGenerator(new LivewireGenerator($app->make(Filesystem::class)));

            return $blueprint;
        });
    }
}
