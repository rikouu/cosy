<?php

namespace App\Models;

use App\Models\Traits\Menuable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class Slide.
 *
 * @property Menuable slideable
 * @property string   title
 */
class Slide extends Model
{
    use Menuable;

    /**
     * @param array $params
     *
     * @return string
     */
    public function getLink($params = [])
    {
        try {
            if (! empty($this->slideable)) {
                return $this->slideable->getLink();
            }
        } catch (\Exception $exception) {
        }

        return $this->url ?? 'javascript:;';
    }

    /**
     * @return MorphTo|null
     */
    public function slideable(): ?MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return string
     */
    public function getName()
    {
        if (isset($this->slideable)) {
            return $this->slideable->getName();
        }

        return $this->title;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        if (isset($this->slideable)) {
            return $this->slideable->image;
        }

        return $this->image ?? cdnPath('images/default.png');
    }
}
