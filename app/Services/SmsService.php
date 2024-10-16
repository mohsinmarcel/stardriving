<?php
namespace App\Services;

use App\Contracts\SmsServiceContract;
use App\Models\Student;
use Twilio\Rest\Client;

class SmsService implements SmsServiceContract{

        private $account_sid;
        private $account_token;
        private $account_from;
        private $reciever;

        public function __construct(){
            $this->account_sid = env("TWILIO_SID");
            $this->account_token = env("TWILIO_TOKEN");
            $this->account_from = env("TWILIO_FROM");
            $this->reciever = new Client($this->account_sid, $this->account_token);
        }

    public function sendSingleSms($phone_number, $message){
        $this->reciever->messages->create($phone_number,[
            'from' => $this->account_from,
            'body' => $message
        ]);
    }
}