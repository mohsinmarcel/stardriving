<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\SettingDetail;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mailSetting = Setting::firstOrCreate([
            "slug"=>"smtp"
        ]);

        SettingDetail::firstOrCreate([
            "setting_id"   => $mailSetting->id,
            "key"           => "MAIL_HOST",
            "value"         => "relay-hosting.secureserver.net",
        ]);
        SettingDetail::firstOrCreate([
            "setting_id"   => $mailSetting->id,
            "key"           => "MAIL_PORT",
            "value"         => "25",
        ]);
        SettingDetail::firstOrCreate([
            "setting_id"   => $mailSetting->id,
            "key"           => "MAIL_USERNAME",
            "value"         => "stardrivingschoolinc@hotmail.com",
        ]);
        SettingDetail::firstOrCreate([
            "setting_id"   => $mailSetting->id,
            "key"           => "MAIL_PASSWORD",
            "value"         => "12345678",
        ]);

        $taxSetting = Setting::firstOrCreate([
            'slug'=>"tax"
        ]);
        SettingDetail::firstOrCreate([
            "setting_id"   => $taxSetting->id,
            "key"           => "gst_tax",
            "value"         => "5",
        ]);
        SettingDetail::firstOrCreate([
            "setting_id"   => $taxSetting->id,
            "key"           => "qst_tax",
            "value"         => "9.9750",
        ]);

        $representativeInformation = Setting::firstOrCreate([
            'slug' => "representative information"
        ]);

        SettingDetail::firstOrCreate([
            "setting_id"   => $representativeInformation->id,
            "key"           => "representative_name",
            "value"         => "Arham Mohammad",
        ]);

        SettingDetail::firstOrCreate([
            "setting_id"   => $representativeInformation->id,
            "key"           => "representative_signature_image",
            "value"         => "",
        ]);

    }
}
