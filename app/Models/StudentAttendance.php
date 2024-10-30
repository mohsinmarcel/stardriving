<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_type_id',
        'class_module_id',
        'teacher_id',
        'start_time',
        'end_time',
        'attendance_date',
        'mark_by',
        'event_id',
        'attendance_category',
    ];
    public function class_type()
    {
        return $this->belongsTo(ClassType::class, 'class_type_id', 'id');
    }
    public function class_module()
    {
        return $this->belongsTo(ClassModule::class, 'class_module_id', 'id');
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }
    public function student_attendance_details()
    {
        return $this->hasMany(StudentAttendanceDetail::class, 'student_attendance_id', 'id');
    }
}
