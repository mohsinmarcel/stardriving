<?php

namespace App\Imports;


use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Str;

class StudentsImport implements WithMultipleSheets 
{

    private $theory_rate;
    private $practical_rate;
    private $taxes;
    public function __construct($theory_rate,$practical_rate,$taxes){
        $this->theory_rate = $theory_rate;
        $this->practical_rate = $practical_rate;
        $this->taxes = $taxes;
    }
    public function sheets(): array
    {
        return [
            new FirstSheetImport($this->theory_rate,$this->practical_rate,$this->taxes)
        ];
    }
    
}
