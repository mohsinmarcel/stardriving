<?php

namespace App\Helpers;

use App\Models\Rate;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use File;

/**
 * Class Helper
 * @package App\Helpers
 */
class Helper
{

   // Helper.php
    /**
     * Convert number of bytes largest unit bytes will fit into.
     * Extracted from WordPress core to work as a standalone function.
     *
     * @link https://codex.wordpress.org/Function_Reference/size_format
     *
     * @param int|string $bytes Number of bytes. Note max integer size for integers.
     * @param int $decimals Optional. Precision of number of decimal places. Default 0.
     *
     * @return string|false False on failure. Number string on success.
     */


    public static function UploadSingleImage(Request $request, $fileName, $storingPath)
    {
        //ANy Function to check either it is exe file to prevent virus
        if ($request->hasFile($fileName) && $request->file($fileName)->isValid()) {
            $file = $request->file($fileName);
            $extension = $file->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;
            $file->move(public_path($storingPath), $filename);
            return $storingPath . '/' . $filename;
        }
        return null;
    }

    public static function UploadMultipleImages(Request $request, $inputName, $storingPath)
    {
                //ANy Function to check either it is exe file to prevent virus

        $uploadedFiles = [];
        if ($request->hasFile($inputName)) {
            foreach ($request->file($inputName) as $file) {
                if ($file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = uniqid() . '.' . $extension;
                    $file->move(public_path($storingPath), $filename);
                    $uploadedFiles[] = $storingPath . '/' . $filename;
                }
            }
        }
        return $uploadedFiles;
    }

    public static function getPriceRates($classId)
    {
        $rate = Rate::where('class_type_id', $classId)->get();
        $data = [];

        if ($rate->count() >= 2) {
            $data['theory'] = (int) $rate[0]->hourly_rate;
            $data['practical'] = (int) $rate[1]->hourly_rate;
            $data['total'] = $data['theory']  + $data['practical'];
        }

        return $data;
    }


}
