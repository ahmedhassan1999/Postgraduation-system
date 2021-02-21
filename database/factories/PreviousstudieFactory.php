<?php

namespace Database\Factories;

use App\Models\Previousstudie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;


class PreviousstudieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Previousstudie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'idSF' => 2,
            'faculty' =>  $this->faker->name,
            'degree' =>  $this->faker->name,
            'university' =>  $this->faker->name,
            'specialization' =>  $this->faker->name,
            'dateObtained' =>  $this->faker->name,

        ];
    }
}
