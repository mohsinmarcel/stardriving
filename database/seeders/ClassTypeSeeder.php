<?php

namespace Database\Seeders;

use App\Models\ClassModule;
use App\Models\ClassType;
use Illuminate\Database\Seeder;

class ClassTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $class_type_modules = [
            "Theoretical" => [
                'The Vehicle (1)',
                'The Driver (2)',
                'The Environment (3)',
                'At-Risk Behaviours (4)',
                'Evaluation (5)',
                'Accompanied Driving (6)',
                'OEA Strategy (7)',
                'Speed (8)',
                'Sharing the Road (9)',
                'Alcohol and Drugs (10)',
                'Fatigue and Distraction (11)',
                'Eco-Driving (12)',
            ],
            "Practical" => [
                'In-Car Session 1',
                'In-Car Session 2',
                'In-Car Session 3',
                'In-Car Session 4',
                'In-Car Session 5',
                'In-Car Session 6',
                'In-Car Session 7',
                'In-Car Session 8',
                'In-Car Session 9',
                'In-Car Session 10',
                'In-Car Session 11',
                'In-Car Session 12',
                'In-Car Session 13',
                'In-Car Session 14',
                'In-Car Session 15',
            ]
        ];
        foreach ($class_type_modules as $key => $value) {
            $class_type = ClassType::firstOrCreate(["name" => $key]);
            foreach ($value as $childkey => $child_value) {
                // ClassModule::withoutEvents(function () use ($class_type, $child_value) {
                    // $abc = ClassModule::firstOrCreate([
                    //     'class_type_id' => $class_type->id,
                    //     'name'=> $child_value,
                    // ]);
                // });
                $abc = new ClassModule();
                $abc->class_type_id = $class_type->id;
                $abc->name = $child_value;
                $abc->saveQuietly();
            }
        }

    }
}