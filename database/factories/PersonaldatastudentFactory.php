<?php

namespace Database\Factories;

use App\Models\Personaldatastudent;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonaldatastudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Personaldatastudent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'englishName' => $this->faker->name,
            'study_type' => $this->faker->name,
            'arabicName' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
