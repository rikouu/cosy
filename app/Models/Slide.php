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
     * @param array $params
     *
     * @return string
     */
    public function getLink($params = [])
    {
        if (!empty($this->url)) {
            return $this->url;
        }

        return 'javascript:;';
    }
}
