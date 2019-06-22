<?php

use Illuminate\Foundation\Mix;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (!function_exists('getAvatar')) {
    function getAvatar($email)
    {
        $hash = Str::length($email) === 32 && ctype_xdigit($email)
            ? Str::lower($email)
            : md5(Str::lower(trim($email)));

        $config = [
            'size' => 96,
            'd'    => 'mm',
            'r'    => 'g',
        ];

        $url = Arr::pull($config, 'url', 'https://secure.gravatar.com/avatar');
        $query = http_build_query($config, '', '&', PHP_QUERY_RFC3986);

        return $url.'/'.$hash.($query ? '?'.$query : '');
    }
}

if (!function_exists('cdnMix')) {
    /**
     * @param        $path
     * @param string $manifestDirectory
     *
     * @return mixed
     */
    function cdnMix($path, $manifestDirectory = '')
    {
        $cdnPath = app(Mix::class)(...func_get_args());
        return cdnPath($cdnPath);
    }
}

if (!function_exists('cdnImage')) {
    /**
     * @param string $path
     *
     * @return string
     */
    function cdnImage($path)
    {
        $url = $path;
        if (!Str::startsWith($path, config('filesystems.disks.qiniu.domain'))) {
            $url = cdnPath($path);
        }
        return $url.'?imageView2/2/w/480/h/320/format/jpg/interlace/1/q/100';
    }
}

if (!function_exists('cdnPath')) {

    /**
     * @param string $path
     *
     * @return mixed
     */
    function cdnPath($path)
    {
        if (!empty(config('cosy.cdn'))) {
            return Storage::disk('qiniu')->getUrl($path);
        }
        return asset($path);
    }
}

if (!function_exists('routeIs')) {
    /**
     * route_is.
     *
     * @param string $expression
     *
     * @return bool
     */
    function routeIs(string $expression)
    {
        return fnmatch($expression, Route::currentRouteName());
    }
}

if (!function_exists('routeIsNot')) {
    /**
     * route_is_not.
     *
     * @param string $expression
     *
     * @return bool
     */
    function routeIsNot(string $expression)
    {
        return !fnmatch($expression, Route::currentRouteName());
    }
}
