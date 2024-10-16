<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCourseDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'theoretical_credit_hours',
        'practical_credit_hours',
        'total_hours',
        'practical_credit_hours_rates',
        'theoretical_credit_hours_rates',
        'sub_total',
        'gst_tax',
        'qst_tax',
        'discount',
        'discount_type',
        'total_amount',
        'remaining_amount',
        'student_id'
    ];

    public function student(){
        return $this->belongsTo(Student::class,'student_id','id');
    }
}
