<?php
namespace App\Repositories;


use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersRepository
{
    public function firstOrCreate(string $name, string $email) : User
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
}