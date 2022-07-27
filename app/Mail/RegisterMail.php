<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;
    public $name , $verify_code ;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name , $v)
    {
        $this->name = $name;
        $this->verify_code = $v;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('register_mail_view')->with([
            'name' => $this->name,
            'verify_code' => $this->verify_code
        ])->subject("Mail Xac thuc tai khoan");
    }
}
