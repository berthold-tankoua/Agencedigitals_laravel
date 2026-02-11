<?php

namespace App\Jobs;

use App\Mail\ClientMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NotificationMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userInfo;

    public function __construct($userInfo)
    {
        $this->userInfo = $userInfo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $clientmsg = [
            'title' => 'AgenceDigitals',
            'objet' => $this->userInfo['subject'],
            'email' => $this->userInfo['email'],
            'message' => $this->userInfo['message'],
            'contact' => $this->userInfo['phone'],
        ];
        Mail::to("brtankoua@gmail.com")->queue(new ClientMail($clientmsg));
    }
}
