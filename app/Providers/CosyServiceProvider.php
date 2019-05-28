<?php

namespace App\Providers;

use App\Cosy\Cosy;
use Illuminate\Support\ServiceProvider;

class CosyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('cosy', function () {
            return $this->app->make(Cosy::class);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
