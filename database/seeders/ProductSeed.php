<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeed extends Seeder
{


    public function run()
    {
        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'camisa polo',
            'description' => 'ropa deportiva',
            'image' => '',
            'price' => 600000,
            'stock' => 10
        ]);
    }
}
