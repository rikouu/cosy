<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Slide
 *
 * @package App\Models
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
