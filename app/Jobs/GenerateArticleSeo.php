<?php

namespace App\Jobs;

use App\Models\Article;
use App\Models\ArticleContent;
use Fukuball\Jieba\Finalseg;
use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\JiebaAnalyse;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Parsedown;

class GenerateArticleSeo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, SerializesModels, Queueable;

    /**
     * @var Article
     */
    protected $article;

    /**
     * GenerateArticleSeo constructor.
     *
     * @param ArticleContent $article
     */
    public function __construct(ArticleContent $article)
    {
        $this->article = $article;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $text = (new Parsedown())->setBreaksEnabled(false)->text($this->article->markdown);
        $text = preg_replace("/<pre[^>]*>(.*?)<\/pre>/is", "", $text);
        $text = strip_tags($text);
        ini_set('memory_limit', '1024M');
        Jieba::init([
            'mode' => 'default',
            'dict' => 'small'
        ]);
        Finalseg::init();
        JiebaAnalyse::init();
        JiebaAnalyse::setStopWords(storage_path('jieba/stopWords.txt'));
        $keywords = JiebaAnalyse::extractTags($text, 20);
        $this->article->keywords = implode(array_keys($keywords), ',');
        $this->article->save();
    }
}
