<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'question_no',
        'correct_answer',
    ];
    public function exam(){
        return $this->belongsTo(Exam::class,'exam_id','id');
    }
    public function student_exam_questions(){
        return $this->hasMany(StudentExamQuestion::class,'exam_question_id','id');
    }
}
