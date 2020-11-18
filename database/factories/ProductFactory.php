<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;



$factory->define(Product::class, function (Faker $faker) {
    return [
        'category_id' => 1,
        'name' => $faker->name,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'price' => $faker->numberBetween($min = 1000, $max = 900000),
        'stock' => 12,
    ];

});
