<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\School;
use App\Models\SchoolYear;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(SchoolYear::class, function (Faker $faker) {
    $startOfSchoolYear = Carbon::createFromDate($faker->year(), 9, $faker->dayOfMonth());
    $endOfSchoolYear = $startOfSchoolYear->copy()->addMonths(10);

    return [
        'school_id' => factory(School::class),
        'name' => "Année scolaire {$startOfSchoolYear->year} - {$endOfSchoolYear->year}",
        'started_at' => $startOfSchoolYear,
        'ended_at' => $endOfSchoolYear,
    ];
});
