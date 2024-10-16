<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    use HasFactory;

    public function studentDocument()
    {
        return $this->belongsTo(StudentDocument::class,'student_dosument_id','id');
    }
}
