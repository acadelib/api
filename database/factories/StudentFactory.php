<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\School;
use App\Models\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'school_id' => factory(School::class),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
    ];
});
