<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;
class Teacher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['first_name','last_name','address','phone_number','gender','signature_image','license_number','license_image','email'];

    protected $appends = ['file_path','full_name'];
    public function getFilePathAttribute()
    {
        // dd($this);
        return asset('/storage/'.$this->signature_image);
    }
    public function getFullNameAttribute()
    {
        // dd($this);
        return $this->first_name.' '.$this->last_name;
    }
    public function setPhoneNumberAttribute($value)
    {
        if($value != '' && $value != null){
        $this->attributes['phone_number'] = '+1'.$value;
        }
    }
    public function getPhoneNumberWithoutCodeAttribute($value)
    {
        return Str::substr($this->phone_number,2);
    }
}
