<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quarters extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'fromdate',
        'todate',
    ];

    // Uncomment the following if you have a relationship with an 'exams' table
    // public function exams()
    // {
    //     return $this->hasMany(Exam::class, 'exam_type_id', 'id');
    // }
}
