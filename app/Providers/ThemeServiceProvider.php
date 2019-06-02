<?php

namespace App\Providers;

use App\Cosy\Theme\Theme as ThemeFactory;
use App\Facades\Theme;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

/**
 * Class ThemeServiceProvider
 *
 * @package App\Providers
 */
class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        View::composer('partials.search', function ($view) {
            $searches = Theme::searchTop();
            $view->with('searches', $searches);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('cosy.theme', function () {
            return $this->app->make(ThemeFactory::class);
        });
    }
}
