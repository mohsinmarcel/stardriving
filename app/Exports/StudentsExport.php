<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class StudentsExport implements FromView
{
    public function view(): View
    {
        return view('import-export.export', [
            'students' => $this->getStudents()
        ]);
    }
    protected function getStudents(){
        $data = DB::select("select *,students.student_id roll_no from students 
        join student_licenses on students.id = student_licenses.student_id
        join student_course_details on students.id = student_course_details.student_id
        join student_contracts on student_contracts.student_id = students.id where students.deleted_at IS NULL");
        return $data;
    }
}
