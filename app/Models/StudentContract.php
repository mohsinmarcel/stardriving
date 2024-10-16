<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentContract extends Model
{
    use HasFactory;

    protected $fillable = ['student_id','beginning_of_contract','end_of_contract'];
}
