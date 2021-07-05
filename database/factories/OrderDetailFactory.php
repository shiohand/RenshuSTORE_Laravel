<?php

namespace Database\Factories;

use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => '1',
            'product_id' => $this->faker->numberBetween(1, 5),
            'price' => '1234',
            'quantity' => $this->faker->numberBetween(1, 5),
        ];
    }
}
