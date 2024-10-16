<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        $this->call([
            PermissionSeeder::class,
            AdminSeeder::class,
            MedicalConditionSeeder::class,
            ClassTypeSeeder::class,
            RateSeeder::class,
            PaymentMethodSeeder::class,
            SettingSeeder::class,
            ExamsQuestionOptionSeeder::class,
            EvaluationTypeSeeder::class,
            PaymentTypeSeeder::class,
            DocumentTypeSeeder::class
        ]);
    }
}
