<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Str;
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
            'name' => $this->faker->name,
            'status' => 'inactive',
            'slug' => $this->faker->slug,
            'shop_id' => \App\Models\Shop::factory(),
            'category_id' => \App\Models\Category::factory(),
            'brand_id' => \App\Models\Brand::factory(),
        ];
    }
}
