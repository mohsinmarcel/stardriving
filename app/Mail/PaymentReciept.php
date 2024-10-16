<?php

namespace App\Mail;

use App\Constants\DatabaseEnumConstants;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentReciept extends Mailable
{
    use Queueable, SerializesModels;

    public $payment_data = [];

    public function __construct($data)
    {
        $this->payment_data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_USERNAME'),'Star Driving School')->subject(DatabaseEnumConstants::PAYMENT_RECEIPT_SUBJECT)->view('email.payment-receipt')->with('payment',$this->payment_data);
    }
}
