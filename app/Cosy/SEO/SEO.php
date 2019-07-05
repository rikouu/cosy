<?php

namespace App\Cosy\SEO;

class SEO
{
    /**
     * @var SEOMeta
     */
    protected $meta;

    /**
     * SEO constructor.
     */
    public function __construct()
    {
        $this->meta = new SEOMeta();
    }

    /**
     * @param bool $minify
     *
     * @return string
     */
    public function generate($minify = false)
    {
        $html = '<meta name="title" content="">';

        return ($minify) ? str_replace(PHP_EOL, '', $html) : $html;
    }
}
