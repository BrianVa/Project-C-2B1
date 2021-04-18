<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SignUpSession extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public function __construct($data)
    {
        dd($data);
        $this->data = $data;

    }

    public function build()
    {
        return $this->markdown('emails.signup')->with('data', $this->data);
    }
}
