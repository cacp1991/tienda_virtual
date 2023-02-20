<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolSeeder extends Seeder
{
        public function run()
        {
            $role1 = Role::create(['name' => 'admin']);
            $role2 = Role::create(['name' => 'user']);

            Permission::create(['name' => 'dashboard.Kart'])->assignRole($role2, $role1);
            Permission::create(['name' => 'dashboard.Products'])->assignRole($role1);
            Permission::create(['name' => 'dashboard.purchases'])->assignRole($role1);
            Permission::create(['name' => 'dashboard.Categories'])->assignRole($role1);
            Permission::create(['name' => 'dashboard.Users'])->assignRole($role1);
        }

}
