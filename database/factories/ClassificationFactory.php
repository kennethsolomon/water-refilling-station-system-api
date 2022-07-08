<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classification>
 */
class ClassificationFactory extends Factory
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
            'delivery_charge' => $this->faker->randomElement([20, 25]),
            'pickup_charge' => $this->faker->randomElement([20, 25]),
            'purchase_charge' => $this->faker->randomElement([20, 25]),
        ];
    }
}
