<?php

use App\Models\CategoryGames;
use App\Models\CategoryMods;
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
            'active'=> true,
            'image'=> null,
            'remember_token' =>null
        ]);
        User::create([
            'name' => 'mateus ulhoa',
            'email' => 'mailto:mateusulhoa061@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Ulhoa0503'), // password
            'type_user'=> 1,
            'active'=> true,
            'image'=> null,
            'remember_token' =>null
        ]);
        
        $categoryGame = ['GTA V', 'GTA SA', ' ETS2', 'GTA IV', 'MODELOS 3D'];
        $categoryMods = ['VEÍCULOS', 'CAMINHÕES', 'ÔNIBUS', 'ARMAS', 'SCRIPTS', 'JOGADOR', 'MAPAS', 'OUTROS', 'FERRAMENTAS', 'CONSTRUÇÕES', 'TEXTURA'];

        foreach($categoryMods as $key => $value){
            CategoryMods::create(['name'=> $value]);
        }

        foreach($categoryGame as $key => $value){
            CategoryGames::create(['name'=> $value]);
        }
    }
}
