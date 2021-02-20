<?php

namespace Database\Factories;

use App\Models\StudyType;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudyTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StudyType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'arabicName' => $this->faker->name,
            'idDeptF' => 1,
        ];
    }
}
