<?php

namespace Database\Seeders;

use App\Models\EvaluationType;
use Illuminate\Database\Seeder;

class EvaluationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $strengths = [
            'Driving in straight line',
            'Stops',
            'Turns',
            'Turning without stop sign',
            'Changing lanes',
            'Speeding',
            'Yield',
            'Road Signs',
            'Observation',
        ];
        foreach ($strengths as $key => $value) {
            EvaluationType::firstOrCreate([
                'name' => $value,
                'type' => 'strength',
                'active' => 1,
                'admin_id' => 1,
            ]);
            EvaluationType::firstOrCreate([
                'name' => $value,
                'type' => 'weakness',
                'active' => 1,
                'admin_id' => 1,
            ]);
        }
        
    }
}
