<?php

namespace Database\Factories;

use App\Models\Registration;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegistrationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Registration::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'arabicTitle' => $this->faker->name,
            'englishTitle' => $this->faker->name,
            'requiredCourses' => $this->faker->name,
            'idSF' => '1',
            'idStudyTypeF' => 1,


        ];
    }
}
