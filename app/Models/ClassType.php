<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassType extends Model
{
    use HasFactory;

    protected $fillable = [
        "name"
    ];

    public function rates(){
        $this->hasOne(Rate::class,'rates_id','id');
    }

    public function classModule()
    {
        return $this->hasMany(ClassModule::class,'class_module_id','id');
    }
}
