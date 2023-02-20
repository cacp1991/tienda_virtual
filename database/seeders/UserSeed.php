<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeed extends Seeder
{

    public function run()
    {
        User::create([
            'number_id' => '1144045278',
            'name' => 'Cristian',
            'last_name' => 'calderon',
            'email' => 'cacp2020@gmail.com',
            'password' => bcrypt(123456789)
        ])->assignRole('admin');

        // DB::table('users')->insert([
        //     'number_id' => '1144045278',
        //     'name' => 'Cristian',
        //     'last_name' => 'calderon',
        //     'email' => 'cacp2020@gmail.com',
        //     'password' => bcrypt(123456789)
        // ]);
    }
}
