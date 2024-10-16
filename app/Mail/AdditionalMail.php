<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdditionalMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mail_detail = [];
    private $report;
    private $attachment_name;

    public function __construct($data,$report=null,$name= '')
    {
        $this->mail_detail = $data;
        $this->report = $report;
        $this->attachment_name =$name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd($this->report);
        $mail =  $this
        ->from(env('MAIL_USERNAME'),'Star Driving School')
        ->subject($this->mail_detail['subject']) // 'Star Driving School '.
        ->view('email.student_mail');
        // if($this->report != null){
            $mail->attach('storage/'.$this->report);
        // }
        return $mail;
        
    }
}
