<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'document_type_id',
        'document',
    ];

    public function student(){
        return $this->belongsTo(Student::class,'student_id','id');
    }

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class,'document_type_id','id');
    }
}
