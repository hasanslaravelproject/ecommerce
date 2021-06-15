<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ProductDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'price' => $this->faker->randomFloat(2, 0, 9999),
            'color' => $this->faker->hexcolor,
            'size' => $this->faker->text(255),
            'discount_type' => 'flat',
            'discount' => $this->faker->randomFloat(2, 0, 9999),
            'description' => $this->faker->text,
            'product_id' => \App\Models\Product::factory(),
        ];
    }
}
