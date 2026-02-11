<?php

namespace App\Services;

use App\Jobs\ChatMailNotif;
use App\Jobs\SendWelcomeEmail;
use App\Models\ChatMessage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ChatService
{

    public function sendMessage(array $datas){

        ChatMessage::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $datas['recevier_id'],
            'link' => $datas['product_link'],
            'msg' => $datas['msg'],
            'created_at' => Carbon::now(),
        ]);

        $receiver= User::findOrfail($datas['recevier_id']);
        // Dispatch du Job pour l’envoi d’e-mail
        $data = array();
        $data['sender_name'] = Auth::user()->name;
        $data['email'] = $receiver->email;
        $data['msg'] = $datas['msg'];
        $data['link'] = $datas['product_link'];
        dispatch(new ChatMailNotif($data));

    } // End Method
}
