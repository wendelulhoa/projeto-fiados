<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'wendel ulhoa',
            'email' => 'wendelulhoa@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'), // password
            'type_user'=> 1,
            'remember_token' =>null
        ]);
        User::create([
            'name' => 'mateus ulhoa',
            'email' => 'mateusulhoa@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'), // password
            'type_user'=> 1,
            'remember_token' =>null
        ]);
    }
}
