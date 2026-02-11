<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MsgMail extends Mailable
{
    use Queueable, SerializesModels;
    public $msgInfo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($msgInfo)
    {
        $this->msgInfo = $msgInfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        return  $this->subject('AgenceDigitals')->view('email.store_msg')->subject('Notification');
    }
}
