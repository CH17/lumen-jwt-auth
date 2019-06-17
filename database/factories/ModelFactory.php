<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name'     => $faker->name,
        'email'    => $faker->unique()->email,
        'password' => app('hash')->make('123456'),
    ];
});


$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'name'     => $faker->colorName,
        'parent_id' => 0
    ];
});

// $factory->defineAs(App\Category::class, function (Faker\Generator $faker) {
//     return [
//         'name'     => $faker->colorName,
//         'parent_id' => $faker->numberBetween(1,5)
//     ];
// });

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'product_name'              => $faker->sentence(5),
        'product_description'       => $faker->text,
        'price'                     => $faker->randomNumber(3),
        'stock'                     => $faker->numberBetween(10,50),
        'category_id'               => $faker->numberBetween(1,10)
    ];
});
