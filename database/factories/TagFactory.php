<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Tag;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {
    $title = $faker->words(3, true);

    return [
        'name'        => $title,
        'slug'        => Str::slug($title),
        'image'       => $faker->imageUrl(),
        'description' => $faker->sentence,
    ];
});
