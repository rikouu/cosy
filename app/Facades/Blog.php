<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Blog
 */
class Blog extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cosy.blog';
    }
}