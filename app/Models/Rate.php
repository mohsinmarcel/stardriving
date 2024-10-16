<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = ['class_type_id','module','no_of_hours','hourly_rate','is_active'];

    public function classType()
    {
        return $this->belongsTo(ClassType::class, 'class_type_id', 'id');
    }

    protected static function booted()
    {
        static::updated(function ($rate) {
            $auth_full_name = Auth::user();
            ActivityLog::create([
            'message' => "New <b>{$rate->classType->name}</b> Rate: <b>{$rate->hourly_rate}</b> updated by <b>{$auth_full_name->full_name}</b>. Old Rate: <b>{$rate->getOriginal('hourly_rate')}</b>."
        ]);
        });
    }
}
