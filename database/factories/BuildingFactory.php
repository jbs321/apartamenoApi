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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
//TODO:: change the hard coded user_id to dynamic one when user implementation is ready
$factory->define(App\Building::class, function (Faker\Generator $faker) {

    return [
        'address' => $faker->unique()->address,
        'user_id' => 1,
    ];
});
