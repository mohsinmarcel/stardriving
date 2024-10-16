<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'payment_method_id',
        'payment_date',
        'payment_type_id',
        'amount',
        'additional_notes',
        'credit_card',
        'debit_card',
        'card_type',
        'cheque_image',
        'admin_id'
    ];

    // public function methodName(){
    //     return $this->hasMany(PaymentMethod::class,'payment_method_id','id');
    // }

    public function student(){
        return $this->belongsTo(Student::class,'student_id','id');
    }

    public function payment_method(){
        return $this->belongsTo(PaymentMethod::class,'payment_method_id','id');
    }
    public function payment_type(){
        return $this->belongsTo(PaymentType::class,'payment_type_id','id');
    }
    public function user(){
        return $this->belongsTo(Admin::class,'admin_id','id');
    }
}
