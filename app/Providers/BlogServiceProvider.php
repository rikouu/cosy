<?php

namespace App\Providers;

use App\Cosy\Blog as BlogFactory;
use Illuminate\Support\ServiceProvider;
use \Blade;

/**
 * Class BlogServiceProvider
 *
 * @package App\Providers
 */
class BlogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('cosy.blog', function () {
            return $this->app->make(BlogFactory::class);
        });
        
        Blade::directive('datetime', function ($expression) {
            return "<?php echo ($expression)->format('m/d/Y H:i'); ?>";
        });

        Blade::directive('image', function ($path) {
            return "<?php echo cdnPath($path); ?>";
        });
    }
}
