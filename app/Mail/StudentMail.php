<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Personaldatastudent;

class StudentMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name;
    public $user_id;
    public $user_name;

    public function __construct($user_id,$user_name,$name)
    {
        $this->name=$name;
        $this->user_id=$user_id;
        $this->user_name=$user_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('Ahmed@example.com')->view('emails.start')->with(
            ['user_id'=>$this->user_id, 'user_name'=>$this->user_name,'name'=>$this->name]
         );
    }
}
