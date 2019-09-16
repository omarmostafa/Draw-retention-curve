<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use App\Models\Applicant;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Applicant::class, function (Faker $faker) {
    return [
        'onboarding_perentage' => array_rand(Applicant::BOARDING_FLOW),
        'count_applications' => rand(1, 4),
        'count_accepted_applications' => rand(1, 3),
        'created_at' => $faker->date(\Carbon\Carbon::today()),
        'user_id' => $faker->uuid
    ];
});
