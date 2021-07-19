<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\BookComment;
use Faker\Generator as Faker;

$factory->define(BookComment::class, function (Faker $faker) {
    return [
        'body' => $faker->realText(),
    ];
});