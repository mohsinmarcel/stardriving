<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class StudentExam extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'exam_id',
        'exam_date',
        'obtained_marks',
        'total_marks',
        'percentage',
        'admin_id',
        'attempts',
    ];
    public function student_exam_questions(){
        return $this->hasMany(StudentExamQuestion::class,'student_exam_id','id');
    }
    public function exam(){
        return $this->belongsTo(Exam::class,'exam_id','id');
    }
    public function student(){
        return $this->belongsTo(Student::class,'student_id','id');
    }
    public function user(){
        return $this->belongsTo(Admin::class,'admin_id','id');
    }
}
