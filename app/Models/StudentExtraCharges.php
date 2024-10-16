<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class StudentExtraCharges extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'charges_type',
        'admin_id',
        'amount',
    ];

    public function student(){
        return $this->belongsTo(Student::class,'student_id','id');
    }

    protected static function booted()
    {
        static::created(function ($studentExtraCharges) {
            ActivityLog::create([
            'message' => "<b>{$studentExtraCharges->charges_type}</b> extra charges of $<b>{$studentExtraCharges->amount}</b> added against <b>{$studentExtraCharges->student->full_name}</b>."
        ]);
        });
    }
}
