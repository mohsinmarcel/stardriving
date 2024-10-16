<?php

namespace Database\Seeders;

use App\Models\ExamQuestionOption;
use Illuminate\Database\Seeder;

class ExamsQuestionOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = ['A','B','C','D'];
        foreach ($options as $key => $value) {
            ExamQuestionOption::firstOrCreate([
                'option' => $value,
                'active' => 1,
            ]);
        }
        
    }
}
