<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Model\User::class, function (Faker\Generator $faker) {
    $gender = ['male', 'female'];
    return [
        'status_id' => rand(1,2),
        'type_id' => rand(1,2),
        'item_report_banned' => 0,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'middle_name' => null,
        'display_name' => $faker->userName,
        'nationality' => $faker->country,
        'phone' => $faker->phoneNumber,
        'photo' => $faker->imageUrl(),
        'gender' => $gender[rand(0, 1)],
        'birth_date' => $faker->dateTime,
        'remember_token' => null,
        'email' => $faker->email,
        'password' => \Illuminate\Support\Facades\Hash::make('test123'),
    ];
});

$factory->define(\App\Model\Category::class, function (Faker\Generator $faker) {
    return [
        'parent_id' => null,
        'name' => $faker->unique()->name,
    ];
});

$factory->define(\App\Model\Item::class, function (Faker\Generator $faker) {
    return [
        'user_id' => rand(1,5),
        'status_id' => rand(1,3),
        'category_id' => rand(1,30),
        'serial_number' => $faker->unique()->uuid,
        'title' => $faker->title,
        'description' => $faker->text,
        'transfer_ownership' => rand(6,5),
        'reward' => rand(30,100)
    ];
});