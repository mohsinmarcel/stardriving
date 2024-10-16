<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use App\Models\PaymentMethodAttribute;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $method = ['Cash','Credit Card','Debit Card','E Transfer','Cheque','Other'];
        foreach ($method as $value) {
            $payment_method = PaymentMethod::firstOrCreate([
                'key' => str_replace(' ', '_', strtolower($value)),
                'name' => $value,
                'description' => '',
                'active' => 1
            ]);
        }
        
    }
}
