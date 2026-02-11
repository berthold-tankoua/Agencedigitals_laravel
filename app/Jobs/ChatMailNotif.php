<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Mail;
use App\Mail\ChatMail;
use App\Models\User;


class ChatMailNotif implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

        protected $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function handle() {
        $mailInfo=[
            'msg' => $this->data['msg'],
            'name' => $this->data['sender_name'],
            'link' => $this->data['link'],
        ];

        Mail::to('brtankoua@gmail.com')->send(new ChatMail($mailInfo));
    }
}
