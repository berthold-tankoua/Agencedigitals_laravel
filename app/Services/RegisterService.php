<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Jobs\SendWelcomeEmail;
use Carbon\Carbon;

class RegisterService
{
    public function register(array $data): User
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'country' => null,
            'city' => null,
            'role' => 'user',
            'phone' => $data['user_phone'],
            'email_verified_at' => Carbon::now(),
            'email_code' => null,
            'created_at' => Carbon::now(),
            'last_seen' => Carbon::now(),
        ]);

        // Dispatch du Job pour l’envoi d’e-mail
        dispatch(new SendWelcomeEmail($user));

        return $user;
    }
}
