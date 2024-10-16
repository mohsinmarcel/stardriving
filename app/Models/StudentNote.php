<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentNote extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id',
        'description',
        'admin_id'
    ];

    public function student(){
        return $this->belongsTo(Student::class,'student_id','id');
    }

    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id','id');
    }
}
