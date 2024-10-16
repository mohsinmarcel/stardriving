<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamType extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
    ];

    public function exams(){
        return $this->hasMany(Exam::class,'exam_type_id','id');
    }
}
