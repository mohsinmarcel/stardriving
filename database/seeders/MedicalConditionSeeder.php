<?php

namespace Database\Seeders;

use App\Models\MedicalCondition;
use Illuminate\Database\Seeder;

class MedicalConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conditions = ["Eye Disease/Disorder","Behavioural Problem","Hearing Impairment","Alcohol and Drugs","Vertigo","Cognitive Impairment","Heart Condition","Epileptic Seizures","Sleep Disorder","Neurological Condition","Significant Movement Limitations","Loss of Consciousness","Diabetes","Daytime Drowsiness"];
        foreach ($conditions as $key => $value) {
            MedicalCondition::firstOrCreate(['name'=> $value]);
        }
        
    }
}
