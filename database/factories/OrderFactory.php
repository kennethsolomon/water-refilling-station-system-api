<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'transaction_id' => $this->faker->randomElement(Transaction::all()->pluck('id')->toArray()),
            'customer_id' => $this->faker->randomElement(Customer::all()->pluck('id')->toArray()),
            'item_id' => $this->faker->randomElement(Item::all()->pluck('id')->toArray()),
            'quantity' => $this->faker->numberBetween(0, 50),
            'type_of_service' => $this->faker->randomElement(['delivery', 'pickup']),
            'is_borrow' => $this->faker->boolean(),
            'is_purchase' => $this->faker->boolean(),
            'is_free' => $this->faker->boolean(),
        ];
    }
}
