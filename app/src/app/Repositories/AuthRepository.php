<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthRepository
{
    public function attempt($credentials, $remember)
    {
        return Auth::attempt($credentials, $remember);
    }

    public function createUser($data)
    {
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);

            return $user;
        });
    }
}
