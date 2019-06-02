<?php

namespace App\Cosy;

class Cosy
{
    public function seo()
    {
        return app('cosy.seo');
    }

    public function name()
    {
        return config('app.name', 'Cosy');
    }
}