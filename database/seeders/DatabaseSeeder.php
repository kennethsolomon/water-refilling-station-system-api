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
            'name' => 'Kenneth',
            'email' => 'kenneth@email.com',

        ]);

        \App\Models\Game::factory(1)->create();
        \App\Models\Player::factory(3)->create();
        \App\Models\Bet::factory(3)->create();
    }
}
