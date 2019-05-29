<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model\Product;
use Faker\Generator as Faker;
use App\User;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name'=> $faker->word,
        'detail'=>$faker->paragraph,
         'price'=>$faker->numberBetween(10000,1000000),
         'stock'=>$faker->randomDigit,
         'discount'=> $faker->numberBetween(2,30),
         'user_id'=> function() {
             return User::all()->random();
         }
    ];
});
