<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Product;
use App\Category;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $categoryid = Category::all()->pluck('id');
    return [
        'name' => $faker->name,
        'quantity' => $faker->randomDigit,
        'category_id' => $faker->randomElement($categoryid),
        'description' => $faker->text,
    ];
});
