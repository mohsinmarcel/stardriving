<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendanceDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_attendance_id',
        'student_id',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
    public function student_attendance()
    {
        return $this->belongsTo(StudentAttendance::class, 'student_attendance_id', 'id');
    }
}
