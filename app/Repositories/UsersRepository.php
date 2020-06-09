<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersRepository
{
    public function firstOrCreate(string $name, string $email): User
    {
        $user = User::firstOrCreate(
            [
                'email' => $email,
            ],
            [
                'name'     => $name,
                'password' => Hash::make(Str::random(16)),
            ]
        );

        $user->update([
            'name' => $name,
        ]);

        return $user;
    }

    public function findByToken(string $token): User
    {
        return User::where('login_token', $token)->firstOrFail();
    }

    public function clearLoginToken(User $user): User
    {
        $user->update([
            'login_token' => null,
        ]);

        return $user;
    }

    public function generateNewLoginToken(User $user): string
    {
        $token = Str::random(16);

        $user->update([
            'login_token' => $token,
        ]);

        return $token;
    }
}
