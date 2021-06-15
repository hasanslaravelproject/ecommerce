<?php

namespace Database\Factories;

use App\Models\OrderDetail;
use Illuminate\Support\Str;
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
            'price' => $this->faker->randomFloat(2, 0, 9999),
            'quantity' => $this->faker->randomNumber,
            'order_id' => \App\Models\Order::factory(),
            'product_id' => \App\Models\Product::factory(),
        ];
    }
}
