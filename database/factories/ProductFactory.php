<?php

/** @var Factory $factory */

use App\Product;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'unit' => 'kg',
        'price' => $faker->randomFloat(2, 0.01, 100),
        'quantity' => $faker->numberBetween(10, 1000),
        'user_id' => $faker->numberBetween(2, User::count()),
    ];
});
