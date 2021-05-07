<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RefressMail extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $form;
    public $id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$form,$id)
    {
        $this->name=$name;
        $this->form=$form;
        $this->id=$id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('Ahmed@example.com')->view('emails.refress')->with(
            ['name'=>$this->name,'form'=>$this->form,'id'=>$this->id])
            ;
    }
}
