<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClientMail extends Mailable
{
    use Queueable, SerializesModels;

    public $clientmsg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($clientmsg)
    {
        $this->clientmsg = $clientmsg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        return  $this->subject('AgenceDigitals')->view('email.message')->subject('Notification');
    }
}
