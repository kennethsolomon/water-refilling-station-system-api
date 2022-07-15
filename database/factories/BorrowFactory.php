<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrow>
 */
class BorrowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'customer_id' => $this->faker->randomElement(Customer::all()->pluck('id')->toArray()),
            'transaction_id' => $this->faker->randomElement(Transaction::all()->pluck('id')->toArray()),
            'order_id' => $this->faker->randomElement(Order::all()->pluck('id')->toArray()),
            'item_id' => $this->faker->randomElement(Item::all()->pluck('id')->toArray()),
            'quantity' => $this->faker->numberBetween(0, 50),
        ];
    }
}
