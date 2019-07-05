<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\Models\ArticleContent;

$factory->define(ArticleContent::class, function (Faker $faker) {
    return [
        'markdown' => '2',
        'is_html'  => false,
        'title'    => '',
        'keywords' => '',
    ];
});
