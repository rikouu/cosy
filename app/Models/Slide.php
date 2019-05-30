<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Slide
 *
 * @property string url
 */
class Slide extends Model
{
    /**
     * @return string
     */
    public function getLink()
    {
        if (!empty($this->url)) {
            return $this->url;
        }
        return 'javascript:;';
    }

}
