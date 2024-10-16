<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentLicense extends Model
{
    use HasFactory;
    protected $fillable = ['student_id','certificate_number','license_number','license_issuing_date','license_expiry_date','student_condition'];
}
