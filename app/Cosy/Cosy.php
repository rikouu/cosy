<?php

namespace App\Cosy;

use App\Cosy\SEO\SEO;

class Cosy
{
    /**
     * @return SEO
     */
    public function seo()
    {
        return app('cosy.seo');
    }

    /**
     * @return string
     */
    public function name()
    {
        return config('app.name', 'Cosy');
    }
}
