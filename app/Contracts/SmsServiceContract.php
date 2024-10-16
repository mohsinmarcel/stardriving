<?php
namespace App\Contracts;
interface SmsServiceContract{

    function sendSingleSms($phone_number, $message);
}