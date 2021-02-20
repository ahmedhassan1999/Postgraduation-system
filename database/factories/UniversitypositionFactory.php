<?php

namespace Database\Factories;

use App\Models\Universityposition;
use Illuminate\Database\Eloquent\Factories\Factory;

class UniversitypositionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Universityposition::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'arabicDegreeName' =>  $this->faker->name,
        ];
    }
}
