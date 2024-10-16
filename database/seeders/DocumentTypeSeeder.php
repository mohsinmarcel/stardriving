<?php

namespace Database\Seeders;

use App\Constants\DatabaseEnumConstants;
use App\Models\DocumentType;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DocumentType::firstOrCreate([
            'id' => 1,
            'name' => 'Driver License',
        ]);
        DocumentType::firstOrCreate([
            'id' => 2,
            'name' => 'Bar Code',
        ]);
        DocumentType::firstOrCreate([
            'id' => 3,
            'name' => 'Transfer Certificate',
        ]);
        DocumentType::firstOrCreate([
            'id' => 4,
            'name' => 'Final Certificate',
        ]);
        DocumentType::firstOrCreate([
            'id' => 5,
            'name' => 'Student Signature',
        ]);
        DocumentType::firstOrCreate([
            'id' => 6,
            'name' => 'Parent Signature',
        ]);
        DocumentType::firstOrCreate([
            'id' => 7,
            'name' => 'Other Document 1',
        ]);
        DocumentType::firstOrCreate([
            'id' => 8,
            'name' => 'Other Document 2',
        ]);
        DocumentType::firstOrCreate([
            'id' => 9,
            'name' => 'Refugee Document',
        ]);
    }
}
