<?php

namespace Database\Factories;

use App\Models\Administrator;
use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdministratorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Administrator::class;

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
}
