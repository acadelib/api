<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Classroom;
use App\Models\SchoolYear;
use Faker\Generator as Faker;

$factory->define(Classroom::class, function (Faker $faker) {
    return [
        'school_year_id' => factory(SchoolYear::class),
        'name' => ucfirst($faker->word),
    ];
});
