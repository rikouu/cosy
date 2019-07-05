<?php

namespace App\Models;

use App\Cosy\Markdown\Markdown;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ArticleContent.
 * @property string  template
 * @property string  type
 * @property bool is_html
 * @property string  html
 * @property string  markdown
 */
class ArticleContent extends Model
{
    /**
     * @return BelongsTo
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * @return mixed|string
     */
    public function content()
    {
        if ($this->is_html) {
            return $this->html;
        }

        return (new Markdown())->convertMarkdownToHtml($this->markdown);
    }
}
