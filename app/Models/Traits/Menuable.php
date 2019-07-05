<?php

namespace App\Models\Traits;

trait Menuable
{
    /**
     * @param array $param
     *
     * @return string
     */
    abstract public function getLink($param = []): string;

    /**
     * @return string
     */
    abstract public function getName(): string;
}
