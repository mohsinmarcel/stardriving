<?php

namespace Database\Seeders;

use App\Constants\DatabaseEnumConstants;
use App\Models\PaymentType;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentType::firstOrCreate([
            'type' => DatabaseEnumConstants::PAYMENT_TYPE_COURSE,
            'active' => 1,
            'created_by' => 'admin',
            'updated_by' => 'admin',
        ]);
        PaymentType::firstOrCreate([
            'type' => DatabaseEnumConstants::PAYMENT_TYPE_EXTRA,
            'active' => 1,
            'created_by' => 'admin',
            'updated_by' => 'admin',
        ]);
    }
}
