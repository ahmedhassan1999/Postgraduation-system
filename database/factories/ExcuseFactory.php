<?php

namespace Database\Factories;

use App\Models\Excuse;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExcuseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Excuse::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'excuseDate' => '2021-02-20 13:18:29',
            'cancelDate' => '2021-02-20 13:18:29',
            'cancelDate' => '2021-02-20 13:18:29',
            'extendedPeriodDocURL' => $this->faker->name,
            'numberMonthExtendedPeriod' => '6',
            'content' => $this->faker->name,
        ];
    }
}
