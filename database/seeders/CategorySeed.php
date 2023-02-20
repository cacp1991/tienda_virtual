<?php

namespace Database\Seeders;

use Illuminate\Http\File;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeed extends Seeder
{

    public function run()
    {
         //1
         DB::table('categories')->insert([
            'name' => 'electrodomesticos',
        ]);

        //2
        DB::table('categories')->insert([

            'name' => 'tecnologia'
        ]);

        //3
        DB::table('categories')->insert([
            'image' => ('/storage/aseo personal.jpeg'),
            'name' => 'aseo personal'
        ]);
    }
}

