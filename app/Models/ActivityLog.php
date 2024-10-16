<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'message'
    ];

    public function getFullNameAttribute()
    {
        // dd($this);
        return $this->first_name.' '.$this->last_name;
    }
}
