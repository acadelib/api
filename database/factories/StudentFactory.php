<?php

namespace Database\Factories;

use App\Models\School;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'school_id' => School::factory(),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
        ];
    }

    /**
     * Indicate that the student has an account to login on the app.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withAccount()
    {
        return $this->state(function () {
            return [
                'user_id' => User::factory(),
            ];
        });
    }
}
