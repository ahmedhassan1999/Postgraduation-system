<?php

namespace Database\Factories;

use App\Models\Supervisor;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupervisorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Supervisor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'idDegreeF' => 1,
            'department' => $this->faker->name,
        ];
    }
}
