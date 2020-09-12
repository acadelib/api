<?php

namespace Database\Factories;

use App\Models\School;
use App\Models\SchoolYear;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolYearFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SchoolYear::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $startOfSchoolYear = Carbon::createFromDate($this->faker->year(), 9, $this->faker->dayOfMonth());
        $endOfSchoolYear = $startOfSchoolYear->copy()->addMonths(10);

        return [
            'school_id' => School::factory(),
            'name' => "Année scolaire {$startOfSchoolYear->year} - {$endOfSchoolYear->year}",
            'started_at' => $startOfSchoolYear,
            'ended_at' => $endOfSchoolYear,
        ];
    }
}
