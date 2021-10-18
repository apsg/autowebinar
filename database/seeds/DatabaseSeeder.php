<?php

use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->seedMe();
    }

    public function seedMe()
    {
        User::firstOrCreate([
            'name'     => 'gacek',
            'email'    => 'szymon.gackowski@gmail.com',
            'password' => \Hash::make(env('DB_PASSWORD')),
            'is_admin' => true,
        ]);
    }
}
