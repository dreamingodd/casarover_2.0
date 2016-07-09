<?php
use Carbon\Carbon;

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

$factory->define(\App\Entity\PcLoginRequest::class, function (Faker\Generator $faker) {
    return [
        'code' => $faker->name,
        'user_id' => mt_rand(1, 8000),
        'status' => mt_rand(1, 3),
        'redirect_url' => str_random(10),
        'created_at' => Carbon::createFromDate(2016, 7, 7, 'America/Toronto'),
    ];
});
