<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

if (!function_exists('getAvatar')) {
    function getAvatar($email)
    {
        $size = 120;
        $hash = Str::length($email) === 32 && ctype_xdigit($email)
            ? Str::lower($email)
            : md5(Str::lower(trim($email)));

        $config = [
            'size' => $size,
        ];

        $url = Arr::pull($config, 'url', 'https://secure.gravatar.com/avatar');
        $query = http_build_query($config, '', '&', PHP_QUERY_RFC3986);

        return $url . '/' . $hash . ($query ? '?' . $query : '');
    }
}

if (!function_exists('route_is')) {
    /**
     * route_is.
     *
     * @param string $expression
     *
     * @return bool
     */
    function route_is(string $expression)
    {
        return fnmatch($expression, Route::currentRouteName());
    }
}

if (!function_exists('route_is_not')) {
    /**
     * route_is_not.
     *
     * @param string $expression
     *
     * @return bool
     */
    function route_is_not(string $expression)
    {
        return !fnmatch($expression, Route::currentRouteName());
    }
}
