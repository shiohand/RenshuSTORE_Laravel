<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'product1',
            'detail' => "product\nproduct\nproduct",
            'price' => (int) round($this->faker->numberBetween(1000, 20000), -2),
            'img' => $this->faker->imageUrl(400, 400),
            'released_at' => '2021-01-'.str_pad($this->faker->numberBetween(1, 31), 2, '0', STR_PAD_LEFT).' 15:00',
        ];
    }
}
