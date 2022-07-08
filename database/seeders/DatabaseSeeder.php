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

        // \App\Models\Game::factory(1)->create();
        // \App\Models\Player::factory(3)->create();
        // \App\Models\Bet::factory(3)->create();

        $this->call([
            ClassificationSeeder::class
        ]);

        \App\Models\Customer::factory(3)->create();
        \App\Models\Item::factory(3)->create();
    }
}
