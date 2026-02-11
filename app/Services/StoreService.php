<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Jobs\SendWelcomeEmail;
use App\Models\Store;
use Carbon\Carbon;

class StoreService
{
    public function storeAgent(array $data, $userId, $storeThumb){

        $store = Store::create([
            'user_id' => $userId,
            'agent_category' => $data['agent_category'],
            'store_name' => $data['store_name'],
            'subscription_id' => null,
            'store_name_slug' => Str::slug($data['store_name']),
            'store_adress' => $data['store_adress'],
            'store_contact' => $data['user_phone'],
            'store_email' => $data['email'],
            'store_descp_fr' => 'Nous mettons à votre disposition une sélection de propriétés soigneusement choisies pour répondre à vos besoins.',
            'store_thambnail' => $storeThumb,
            'status' => 1,
            'raiting' => 5,
            'created_at' => Carbon::now(),
        ]);

     return $store;
    }
}
