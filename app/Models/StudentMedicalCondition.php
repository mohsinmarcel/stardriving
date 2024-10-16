<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMedicalCondition extends Model
{
    use HasFactory;
    protected $fillable = ["student_id","medical_condition_id","status"];

    public function student(){
        return $this->belongsTo(Student::class,'student_id','id');
    }
    public function medical_condition(){
        return $this->belongsTo(MedicalCondition::class,'medical_condition_id','id');
    }
}
