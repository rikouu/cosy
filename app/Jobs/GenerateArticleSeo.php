<?php

namespace App\Jobs;

use App\Models\Article;
use Fukuball\Jieba\Finalseg;
use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\JiebaAnalyse;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Parsedown;

class GenerateArticleSeo extends Job
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    /**
     * @var Article
     */
    protected $article;

    /**
     * GenerateArticleSeo constructor.
     *
     * @param Article $article
     */
    public function __construct(Article $article)
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
        $this->article->load(['content']);
        $content = $this->article->content;
        $text = (new Parsedown())->setBreaksEnabled(false)->text($content->markdown);
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
        $content->keywords = implode(array_keys($keywords), ',');
        $content->save();
    }
}
