<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SettingDetail extends Model
{
    use HasFactory;

    protected $fillable = ['settings_id','key','value'];

    public function setting(){
        return $this->belongsTo(Setting::class, 'settings_id', 'id');
    }

    protected static function booted()
    {
        static::updated(function ($settingDetail) {
            // $settings = Setting::all();
            $auth_full_name = Auth::user();
            ActivityLog::create([
            'message' => " <b>{$settingDetail->key}</b> : <b>{$settingDetail->value}</b> updated in settings by <b>{$auth_full_name->full_name}</b>. Old Value: <b>{$settingDetail->getOriginal('value')}</b>."
            ]);
        });
    }
}
