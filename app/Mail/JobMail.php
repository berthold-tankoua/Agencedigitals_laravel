<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobMail extends Mailable
{
    use Queueable, SerializesModels;
    public $notif_admin_Info;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($notif_admin_Info)
    {
        $this->notif_admin_Info = $notif_admin_Info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return  $this->subject('AgenceDigitals')->view('email.admin_job_notif')->subject('Notification');
    }
}
