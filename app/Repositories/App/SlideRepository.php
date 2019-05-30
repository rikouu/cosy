<?php

namespace App\Repositories\App;

use App\Models\Slide;
use App\Repositories\Repository;

class SlideRepository extends Repository
{

    /**
     * @return mixed
     */
    public function top()
    {
        $slides = Slide::take(5)->get();
        $count = $slides->count();
        while ($count < 5) {
            $slides->push(new Slide());
            $count++;
        }
        return $slides;
    }
}
