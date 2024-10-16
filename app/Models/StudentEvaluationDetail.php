<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentEvaluationDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'student_evaluation_id',
        'type',
        'evaluation_by'
    ];
    public function student_evaluation(){
        return $this->belongsTo(StudentEvaluation::class,'student_evaluation_id','id');
    }
}
