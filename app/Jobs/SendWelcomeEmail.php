<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;
use App\Models\User;

class SendWelcomeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function handle() {
        $regisInfo=[
            'title' => 'Mail de Bienvenue',
            'name' => $this->user->name,
        ];

        Mail::to($this->user->email)->send(new RegisterMail($regisInfo));
    }
}
