<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentExamQuestion extends Model
{
    use HasFactory;

    protected $fillable=[
        'student_exam_id',
        'exam_question_id',
        'correct',
        'answer',
    ];
    public function student_exam(){
        return $this->belongsTo(StudentExam::class,'student_exam_id','id');
    }
    public function exam_question(){
        return $this->belongsTo(ExamQuestion::class,'exam_question_id','id');
    }
}
