<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;
class Student extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'student_id',
        'first_name',
        'last_name',
        'gender',
        'dob',
        'email',
        'phone_number_1',
        'phone_number_2',
        'address',
        'postal_code',
        'city',
        'province',
        'status_in_canada',
        'is_live_in_canada',
        'is_medical_condition',
        'student_type', //enum('new','transfer')
        'student_status', //enum('enrolled','passed','cancelled','certificate given')
        'theroy_exam_date',
        'knowledge_test_date',
        'knowledge_test_time',
        'knowledge_test_location',
        'theroy_test_time',
        'theroy_test_location',
        'isextrastudent'
    ];

    public function getFullNameAttribute()
    {
        // dd($this);
        return $this->first_name.' '.$this->last_name;
    }

    public function setPhoneNumber1Attribute($value)
    {
        if($value != '' && $value != null){
        $this->attributes['phone_number_1'] = '+1'.$value;
        }
    }

    public function setPhoneNumber2Attribute($value)
    {
        if($value != '' && $value != null){
            $this->attributes['phone_number_2'] = '+1'.$value;
        }
    }
    public function getPhoneOneWithoutCodeAttribute(){
        return Str::substr($this->phone_number_1,2);
    }
    public function getPhoneTwoWithoutCodeAttribute(){
        return Str::substr($this->phone_number_2,2);
    }
    public function studentPaymentMethod(){
        return $this->hasMany(StudentPayment::class,'student_id','id');
    }

    public function studentCourseDetail(){
        return $this->hasOne(StudentCourseDetail::class,'student_id','id');
    }

    public function studentDocument(){
        return $this->hasMany(StudentDocument::class,'student_id','id');
    }

    public function studentExtraCharges(){
        return $this->hasMany(StudentExtraCharges::class,'student_id','id');
    }

    public function studentNote(){
        return $this->hasMany(StudentNote::class,'student_id','id');
    }

    public function studentMedicalCondition(){
        return $this->hasMany(StudentMedicalCondition::class,'student_id','id');
    }

    public function studentSessionEvaluation(){
        return $this->hasMany(StudentEvaluation::class,'student_id','id');
    }



}
