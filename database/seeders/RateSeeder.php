<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rate;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rate::insert([
            [
                'class_type_id' => 1,
                'module' => '12',
                'no_of_hours' => '24',
                'hourly_rate' => '12.4897'
            ],
            [
                'class_type_id' => 2,
                'module' => '15',
                'no_of_hours' => '15',
                'hourly_rate' => '38'
            ],
        ]);
    }
}
