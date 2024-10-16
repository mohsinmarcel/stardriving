<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentEvaluation extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'teacher_id',
        'session',
        'date',
        'student_signature',
        'admin_id',
    ];
    protected $appends = ['file_path'];
    public function getFilePathAttribute()
    {
        // dd($this);
        return asset('/storage/'.$this->student_signature);
    }
    public function student_evaluation_details(){
        return $this->hasMany(StudentEvaluationDetail::class,'student_evaluation_id','id');
    }
    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
    public function teacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }
}
