<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UncompletedRegMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sid;
    public $sname;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id, $name)
    {
        $this->sid = $id;
        $this->sname = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("confirmation mail")->view('emails.uncompletedReg');
    }
}
