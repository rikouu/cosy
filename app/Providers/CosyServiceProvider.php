<?php

namespace App\Providers;

use App\Cosy\Cosy;
use App\Cosy\SEO\SEO;
use Illuminate\Support\ServiceProvider;

/**
 * Class CosyServiceProvider
 *
 * @package App\Providers
 */
class CosyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('cosy.seo', function () {
            return new SEO();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('cosy', function () {
            return new Cosy();
        });
    }
}
