<?php

namespace App\Models\Traits;

trait Menuable
{

    /**
     * @param array $param
     *
     * @return string
     */
    abstract function getLink($param = []): string;

    /**
     * @return string
     */
    abstract function getName(): string;

}
