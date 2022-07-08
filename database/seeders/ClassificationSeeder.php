<?php

namespace Database\Seeders;

use App\Models\Classification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Classifications = [
            [
                'name' => 'house-hold',
                'description' => 'house-hold description',
                'delivery_charge' => 25,
                'pickup_charge' => 25,
                'purchase_charge' => 25,
            ],
            [
                'name' => 'reseller',
                'description' => 'reseller description',
                'delivery_charge' => 20,
                'pickup_charge' => 20,
                'purchase_charge' => 20,
            ],
            [
                'name' => 'dealer',
                'description' => 'dealder description',
                'delivery_charge' => 25,
                'pickup_charge' => 25,
                'purchase_charge' => 25,
            ]
        ];
        Classification::upsert($Classifications, []);
    }
}
