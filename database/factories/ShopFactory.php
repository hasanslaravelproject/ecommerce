<?php

namespace Database\Factories;

use App\Models\Shop;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shop::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'email' => $this->faker->email,
            'password' => $this->faker->text(255),
            'profile_image' => $this->faker->text(255),
            'status' => 'Inactive',
        ];
    }
}
