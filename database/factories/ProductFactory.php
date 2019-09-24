<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
       'title'=>$faker->sentence,
       'description'=>$faker->paragraph(5),
       'unit'=>$faker->randomElement(['kilo gram', 'quantity','meter']),
        'price'=>$faker->randomFloat(2, 10, 500),
        'total'=>$faker->numberBetween(2, 250),


    ];
});
