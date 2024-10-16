<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'admin_id',
        'exam_type_id',
        'total_questions',
        'marks_per_question',
        'active',
    ];
    public function student_exams(){
        return $this->hasMany(StudentExam::class,'exam_id','id');
    }
    public function exam_type(){
        return $this->belongsTo(ExamType::class,'exam_type_id','id');
    }
    public function exam_questions(){
        return $this->hasMany(ExamQuestion::class,'exam_id','id');
    }
}
