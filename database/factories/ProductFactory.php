<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'unit' => 'kg',
        'price' => $faker->randomFloat(2, 0.01, 100),
        'quantity' => $faker->numberBetween(10, 1000),
    ];
});
