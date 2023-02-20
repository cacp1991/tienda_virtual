<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Kart;
use App\Models\Product;
use Database\Seeders\UserSeed;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call([
            // UserSeed::class,
            // CategorySeed::class,
            // ProductSeed::class,
            // Rolseeder::class
        ]);

        // User::factory(100)->create();
        // Product::factory(100)->create();
        // Kart::factory(100)->create();
    }
}

