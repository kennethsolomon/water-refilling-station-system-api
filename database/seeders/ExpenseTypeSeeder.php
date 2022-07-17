<?php

namespace Database\Seeders;

use App\Models\ExpenseType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ExpenseType = [
            [
                'title' => 'Item',
            ],
            [
                'title' => 'Salary',
            ],
        ];
        ExpenseType::upsert($ExpenseType, []);
    }
}
