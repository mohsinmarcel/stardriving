<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['slug'];

    public function settingDetails(){
        return $this->hasMany(SettingDetail::class, 'setting_details_id', 'id');
    }
}
