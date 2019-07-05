<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Cosy.
 */
class Cosy extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cosy';
    }

    /**
     * Admin path.
     *
     * @return string
     */
    public static function path()
    {
        return config('admin.path', '/admin');
    }
}
