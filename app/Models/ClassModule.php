<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModule extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_type_id',
        'name',
        'active',
    ];

    public function classType()
    {
        return $this->belongsTo(ClassType::class,'class_type_id','id');
    }
}
