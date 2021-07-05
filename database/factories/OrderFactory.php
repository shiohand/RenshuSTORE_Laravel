<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 5),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'postal1' => $this->faker->numberBetween(100, 900),
            'postal2' => $this->faker->numberBetween(1000, 9000),
            'address' => $this->faker->streetAddress(),
            'tel' => $this->faker->phoneNumber(),
        ];
    }
}
