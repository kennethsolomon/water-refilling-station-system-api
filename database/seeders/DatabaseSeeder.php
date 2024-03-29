<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\User::factory()->create([
            'email' => 'kenneth@email.com',
        ]);

        $this->call([
            ExpenseTypeSeeder::class
        ]);

        \App\Models\Employee::factory(10)->create();
        // \App\Models\Customer::factory(10)->create();
        \App\Models\Item::factory(10)->create();
        // \App\Models\Transaction::factory(1)->create();
        // \App\Models\Order::factory(1)->create();
        // \App\Models\Borrow::factory(1)->create();
    }
}
