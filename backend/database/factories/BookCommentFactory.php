<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\BookComment;
use Faker\Generator as Faker;

$factory->define(BookComment::class, function (Faker $faker) {
    return [
        'book_id' => rand(1, 300),
        'body' => $faker->realText($maxNbChars = rand(20, 40)),
    ];
});