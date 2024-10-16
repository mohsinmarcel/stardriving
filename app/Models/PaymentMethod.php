<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $fillable = ['key','name','description','active'];

    public function paymentMethod(){
        return $this->hasMany(StudentPayment::class,'payment_method_id','id');
    }
}
