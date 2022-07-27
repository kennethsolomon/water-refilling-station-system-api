<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'pickup_price' => $this->faker->numberBetween(20, 30),
            'delivery_price' => $this->faker->numberBetween(20, 30),
            'purchase_price' => $this->faker->numberBetween(150, 200),
            'quantity' => $this->faker->numberBetween(99, 200),
            'is_pos' => $this->faker->boolean(),
        ];
    }
}
