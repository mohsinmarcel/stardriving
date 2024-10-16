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
        Validator::make($collection->toArray(), [
            '*.studentid' => 'required|unique:students,student_id,NULL,id,deleted_at,NULL',
            '*.firstname' => 'required|string|max:100',
            '*.lastname' => 'required|string|max:100',
            '*.gender' => 'required|string|max:10',
            // '*.date_of_birth' => 'required|date|before:today',
            '*.phonenumberone' => 'nullable|regex:/^[0-9]{10}$/',
            '*.phonenumbertwo' => 'nullable|regex:/^[0-9]{10}$/',
            '*.email' => 'nullable|email|unique:students,email,NULL,id,deleted_at,NULL',
            '*.statusincanada' => 'nullable|string|max:120',
            '*.address' => 'nullable|string|max:200',
            '*.postalcode' => 'nullable|max:20',
            '*.city' => 'nullable|string|max:200',
            '*.provine' => 'nullable|string|max:200',
            '*.isnewstudent' => 'required',
            '*.certificatenumber' => 'nullable|max:50',
            '*.licensenumber' => 'nullable|required_with:licenseissuingdate|required_with:licenseexpirydate|max:50',
            '*.licenseissuingdate' => 'nullable|required_with:licensenumber',
            '*.licenseexpirydate' => 'nullable|required_with:licensenumber',
            '*.studentcondition' => 'nullable|string',
            '*.theoreticalclasshours' => 'required|numeric|min:0|max:'.$this->theory_rate->no_of_hours,
            '*.practicalclasshours' => 'required|numeric|min:0|max:'.$this->practical_rate->no_of_hours,
            '*.discountamount' => ['nullable','numeric'],
            '*.beginningofcontract' => 'nullable',
            '*.endofcontract' => 'nullable'
        ])->validate();

        foreach ($collection as $row) 
        {
            try{
                // $dob = $row['dateofbirth'];
                // dd($row['']);
                $license_issuing_date = $this->format_date($row['licenseissuingdate']);
                $license_expiry_date = $this->format_date($row['licenseexpirydate']);
                $date_of_birth = $this->format_date($row['dateofbirth']);
                DB::beginTransaction();
                $student = Student::create([
                    'student_id' => $row['studentid'],
                    'first_name' => $row['firstname'],
                    'last_name' => $row['lastname'],
                    'gender' => Str::lower($row['gender']),
                    'dob' => $date_of_birth,
                    'email' => $row['email'],
                    'phone_number_1' => $row['phonenumberone'],
                    'phone_number_2' => $row['phonenumbertwo'],
                    'address' => $row['address'],
                    'postal_code' => $row['postalcode'],
                    'city' => $row['city'],
                    'province' => $row['province'],
                    'status_in_canada' => $row['statusincanada'],
                    'is_live_in_canada' => $row['statusincanada'] == null?0:1,
                    'is_medical_condition' => $row['ismedicalcondition'] == 'yes'?1:0,
                    'student_type' => $row['isnewstudent'] == 'yes'?'new':'transfer',
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
                    'certificate_number' => $row['certificatenumber'],
                    'license_number' => $row['licensenumber'],
                    'license_issuing_date' => $license_issuing_date,
                    'license_expiry_date' => $license_expiry_date,
                    'student_condition' => $row['studentcondition']
                ]);
                	
                StudentCourseDetail::create([
                    'theoretical_credit_hours'=> $row['theoreticalclasshours'],
                    'practical_credit_hours'=> $row['practicalclasshours'],
                    'total_hours'=> $row['theoreticalclasshours'] + $row['practicalclasshours'],
                    'practical_credit_hours_rates'=> $this->practical_rate->hourly_rate,
                    'theoretical_credit_hours_rates'=> $this->theory_rate->hourly_rate,
                    'sub_total'=> (($this->practical_rate->hourly_rate * $row['practicalclasshours'])+($this->theory_rate->hourly_rate*$row['theoreticalclasshours'])),
                    'gst_tax'=> (float)$row['gsttax'],
                    'qst_tax'=> (float)$row['qsttax'],
                    'discount'=> $row['discountamount'] != null ? $row['discountamount'] : 0,
                    'discount_type'=> $row['discountamount'] == null ? 'none' : ($row['ispercentdiscount'] == 'yes'?'percent':'price'),
                    'total_amount'=> $this->total_amount($row),
                    'remaining_amount' => $this->total_amount($row),
                    'student_id' => $student->id
                ]);
                StudentContract::create([
                    'student_id' => $student->id,
                    'beginning_of_contract' => $this->format_date($row['beginningofcontract']),
                    'end_of_contract' => $this->format_date($row['endofcontract'])
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
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date))->format('Y-m-d');
        else
            return null;
    }
    protected function total_amount($row){
        // $taxes = ['gst_tax' => $tax[0]['value'],'qst_tax' => $tax[1]['value']];
        $sub_total = (($this->practical_rate->hourly_rate * $row['practicalclasshours'])+($this->theory_rate->hourly_rate*$row['theoreticalclasshours']));
        $gst = ($row['gsttax']/100)*$sub_total;
        $qst = ($row['qsttax']/100)*$sub_total;
        $total_amount = $sub_total+$gst+$qst;
        if($row['discountamount'] != null){
            if($row['ispercentdiscount'] == 'yes'){
                $discountAmount = ($row['discountamount']/100) * $total_amount;
                $total_amount -= $discountAmount;
            }else{
                $total_amount -= $row['discountamount'];
            }
        }
        return round($total_amount,2);
    }
}
