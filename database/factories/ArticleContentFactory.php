<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\ArticleContent;
use Faker\Generator as Faker;

$factory->define(ArticleContent::class, function (Faker $faker) {
    return [
        'markdown' => '2',
        'is_html'  => false,
        'title'    => '',
        'keywords' => '',
    ];
});
