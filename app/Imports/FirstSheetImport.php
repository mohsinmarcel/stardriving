<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;
use Str;
use App\Models\MedicalCondition;
use App\Models\Student;
use App\Models\StudentContract;
use App\Models\StudentCourseDetail;
use App\Models\StudentLicense;
use App\Models\StudentMedicalCondition;
use App\Rules\Discount;
use Exception;
use Validator;

class FirstSheetImport implements ToCollection,WithHeadingRow
{
    private $theory_rate;
    private $practical_rate;
    private $taxes;
    public function __construct($theory_rate,$practical_rate,$taxes){
        $this->theory_rate = $theory_rate;
        $this->practical_rate = $practical_rate;
        $this->taxes = $taxes;
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        // dd($collection);
        Validator::make($collection->toArray(), [
            '*.student_id' => 'required|unique:students,student_id,NULL,id,deleted_at,NULL',
            '*.first_name' => 'required|string|max:100',
            '*.last_name' => 'required|string|max:100',
            '*.gender' => 'required|string|max:10',
            // '*.date_of_birth' => 'required|date|before:today',
            '*.phone_no_1' => 'nullable',
            '*.phone_no_2' => 'nullable',
            '*.email' => 'nullable|email|unique:students,email,NULL,id,deleted_at,NULL',
            '*.status_in_canada' => 'nullable|string|max:120',
            '*.address' => 'nullable|string|max:200',
            '*.postal_code' => 'nullable|max:20',
            '*.city' => 'nullable|string|max:200',
            '*.province' => 'nullable|string|max:200',
            '*.is_new_student' => 'required',
            '*.certificate_number' => 'nullable|max:50',
            '*.license_number' => 'nullable|required_with:license_issue_date|required_with:license_expire_date|max:50',
            '*.license_issue_date' => 'nullable|required_with:license_number',
            '*.license_expire_date' => 'nullable|required_with:license_number',
            '*.student_condition' => 'nullable|string',
            '*.theoretical_class_hours' => 'required|numeric|min:0|max:'.$this->theory_rate->no_of_hours,
            '*.practical_class_hours' => 'required|numeric|min:0|max:'.$this->practical_rate->no_of_hours,
            '*.discount_amount' => ['nullable','numeric'],
            '*.beginning_of_contract' => 'nullable',
            '*.end_of_contract' => 'nullable'
        ])->validate();

        foreach ($collection as $row)
        {
            try{
                // $dob = $row['dateofbirth'];
                // dd($row['']);
                $license_issuing_date = $this->format_date($row['license_issue_date']);
                $license_expiry_date = $this->format_date($row['license_expire_date']);
                $date_of_birth = $this->format_date($row['date_of_birth']);
                DB::beginTransaction();
                $student = Student::create([
                    'student_id' => $row['student_id'],
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name'],
                    'gender' => Str::lower($row['gender']),
                    'dob' => $date_of_birth,
                    'email' => $row['email'],
                    'phone_number_1' => $row['phone_no_1'],
                    'phone_number_2' => $row['phone_no_2'],
                    'address' => $row['address'],
                    'postal_code' => $row['postal_code'],
                    'city' => $row['city'],
                    'province' => $row['province'],
                    'status_in_canada' => $row['status_in_canada'],
                    'is_live_in_canada' => $row['status_in_canada'] == null?0:1,
                    'is_medical_condition' => $row['is_medical_condition'] == 'yes'?1:0,
                    'student_type' => $row['is_new_student'] == 'yes'?'new':'transfer',
                    'student_status' => 'enrolled'
                ]);
                $medicalConditions = MedicalCondition::where('active',1)->get();
                foreach ($medicalConditions as $key => $value) {
                    StudentMedicalCondition::create([
                        "student_id" => $student->id,
                        "medical_condition_id" => $value->id,
                        "status" => 0
                    ]);
                }
                StudentLicense::create([
                    'student_id' => $student->id,
                    'certificate_number' => $row['certificate_number'],
                    'license_number' => $row['license_number'],
                    'license_issuing_date' => $license_issuing_date,
                    'license_expiry_date' => $license_expiry_date,
                    'student_condition' => $row['student_condition']
                ]);

                StudentCourseDetail::create([
                    'theoretical_credit_hours'=> $row['theoretical_class_hours'],
                    'practical_credit_hours'=> $row['practical_class_hours'],
                    'total_hours'=> $row['theoretical_class_hours'] + $row['practical_class_hours'],
                    'practical_credit_hours_rates'=> $this->practical_rate->hourly_rate,
                    'theoretical_credit_hours_rates'=> $this->theory_rate->hourly_rate,
                    'sub_total'=> (($this->practical_rate->hourly_rate * $row['practical_class_hours'])+($this->theory_rate->hourly_rate*$row['theoretical_class_hours'])),
                    'gst_tax'=> (float)$row['gst_tax'],
                    'qst_tax'=> (float)$row['qst_tax'],
                    'discount'=> $row['discount_amount'] != null ? $row['discount_amount'] : 0,
                    'discount_type'=> $row['discount_amount'] == null ? 'none' : ($row['is_discount_in_percent'] == 'yes'?'percent':'price'),
                    'total_amount'=> $this->total_amount($row),
                    'remaining_amount' => $this->total_amount($row),
                    'student_id' => $student->id
                ]);
                StudentContract::create([
                    'student_id' => $student->id,
                    'beginning_of_contract' => $this->format_date($row['beginning_of_contract']),
                    'end_of_contract' => $this->format_date($row['end_of_contract'])
                ]);

                DB::commit();
            }catch(Exception $ex){
                DB::rollback();
                throw $ex;
            }
        }
    }
    protected function format_date($date){
        if($date != null)
            // return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date))->format('Y-m-d');
            return \Carbon\Carbon::parse($date)->format('Y-m-d');
        else
            return null;
    }
    protected function total_amount($row){
        // $taxes = ['gst_tax' => $tax[0]['value'],'qst_tax' => $tax[1]['value']];
        $sub_total = (($this->practical_rate->hourly_rate * $row['practical_class_hours'])+($this->theory_rate->hourly_rate*$row['theoretical_class_hours']));
        $gst = ($row['gst_tax']/100)*$sub_total;
        $qst = ($row['qst_tax']/100)*$sub_total;
        $total_amount = $sub_total+$gst+$qst;
        if($row['discount_amount'] != null){
            if($row['is_discount_in_percent'] == 'yes'){
                $discountAmount = ($row['discount_amount']/100) * $total_amount;
                $total_amount -= $discountAmount;
            }else{
                $total_amount -= $row['discount_amount'];
            }
        }
        return round($total_amount,2);
    }
}
