<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
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
            'employee_id' => $this->faker->randomElement(Employee::all()->pluck('id')->toArray()),
            'discount' => $this->faker->numberBetween(0, 10),
            'credit' => $this->faker->numberBetween(0, 200),
            'status' => $this->faker->randomElement(['done', 'active']),
            'transaction_date' => $this->faker->date(),
        ];
    }
}
