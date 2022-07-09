<?php

namespace Database\Factories;

use App\Models\Borrow;
use App\Models\Classification;
use App\Models\OwnedItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'classification_id' => $this->faker->randomElement(Classification::all()->pluck('id')->toArray()),
            // 'borrow_id' => $this->faker->randomElement(Borrow::all()->pluck('id')->toArray()),
            // 'owned_item_id' => $this->faker->randomElement(OwnedItem::all()->pluck('id')->toArray()),
            'firstname' => $this->faker->firstName(),
            'middlename' => $this->faker->lastName(),
            'lastname' => $this->faker->lastName(),
            'address' => $this->faker->address(),
            'contact_number' => $this->faker->phoneNumber(),
        ];
    }
}
