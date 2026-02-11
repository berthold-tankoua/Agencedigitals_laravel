<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    public $resetInfo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($resetInfo)
    {
        $this->resetInfo = $resetInfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        return  $this->subject('AgenceDigitals')->view('email.send_code')->subject('Code de verification');
    }
}
