<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'receiptNumber' => '100',
            'amountPaid' => '100',
            'URLImage' => $this->faker->name,
            'paymentDate' => '2021-02-20 13:18:29',
            'forYear' =>'2021-02-20 13:18:29',
        ];
    }
}
