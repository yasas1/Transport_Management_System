<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApprovedByMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $address;
    public $place;
    public $start;
    public $end;
    public $applicant;

    public function __construct($address,$place,$start,$end,$applicant)
    {
        $this->address = $address;
        $this->place = $place;
        $this->start = $start;
        $this->end = $end;
        $this->applicant = $applicant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Mail.mailForApprovedBy',['place'=>$this->place,'start'=>$this->start,'end'=>$this->end,'applicant'=>$this->applicant])->to($this->address);
    }
}
