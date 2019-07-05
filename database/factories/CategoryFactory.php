<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Category;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $title = $faker->sentence(mt_rand(1, 3));

    return [
        'name'        => $title,
        'slug'        => Str::slug($title),
        'image'       => $faker->imageUrl(),
        'description' => $faker->sentence,
    ];
});
