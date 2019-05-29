<?php

namespace App\Cosy\Markdown;

use Parsedown;

class Markdown
{

    /**
     * @var Parsedown
     */
    protected $markdownConverter;

    /**
     * Markdown constructor.
     */
    public function __construct()
    {
        $this->markdownConverter = new Parsedown();
    }

    public function convertMarkdownToHtml($markdown)
    {
        return $this->markdownConverter
            ->setBreaksEnabled(true)
            ->text($markdown);
    }

}