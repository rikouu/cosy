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

        return $url . '/' . $hash . ($query ? '?' . $query : '');
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

if (!function_exists('cdnPath')) {

    /**
     * @param string $path
     *
     * @return mixed
     */
    function cdnPath($path)
    {
        if (!empty(config('filesystems.disks.qiniu.access_key'))) {
            $storage = Storage::disk('qiniu');
            $filePath = explode('?', $path)[0];
            if (config('app.debug', false) && !$storage->has($filePath)) {
                try {
                    $storage->writeStream($filePath, fopen(public_path($filePath), 'r'));
                } catch (Exception $e) {
                    return $path;
                }
            }
            return $storage->getUrl($path);
        }
        return $path;
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
