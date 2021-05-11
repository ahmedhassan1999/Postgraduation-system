<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SupervisorMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sId;
    public $sName;
    public $formLink;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id, $name, $form)
    {
        $this->sId = $id;
        $this->sName = $name;
        $this->formLink = $form;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("registration form")->view('emails.supervisor');
    }
}
