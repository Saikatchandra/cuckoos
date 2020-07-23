<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\ProductCategory;
use App\ProductGallery;
use App\Rating;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


// Product Factory
$factory->define(Product::class, function (Faker $faker) {
    $sentence = $faker->sentence; 
    $number = rand(10, 100);
    $image = "https://picsum.photos/id/$number/800/550";
    $word = $faker->word;

    return [
        'title' => $sentence,
        'slug' => Str::slug($sentence),
        'category_id' => function(){
            return ProductCategory::inRandomOrder()->first()->id;
        },
        'brand_id' => 1,
        'image' => $image,
        'description' => $faker->paragraph($nbSentences = 5, $variableNbSentences = true),
        'information' => $faker->paragraph($nbSentences = 5, $variableNbSentences = true),
        'stock' => rand(36, 99),
        'price' => rand(9600, 98630),
        'sale_price' => rand(3010, 9500),
        'sku' => $word.$number,
    ];
});



// Gallery Factory
$factory->define(ProductGallery::class, function (Faker $faker) {
    $number = rand(50, 500);
    $image = "https://picsum.photos/id/$number/800/550";
    return [
        'image' => $image,
        'product_id' => 1,
    ];
});


// Product Rating
$factory->define(Rating::class, function(Faker $faker){
    return [
        'feedback' => $faker->sentence(100),
        'star' => rand(1, 5),
        'product_id' => function(){
            return Product::inRandomOrder()->first()->id;
        },
        'user_id' => function(){
            return User::inRandomOrder()->first()->id;
        }
    ];
});