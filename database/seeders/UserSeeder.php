<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        foreach (Permission::PERMISSIONS as $key => $value) {
            Permission::create([
                'name' => $key,
                'display_name' => $value,
            ]);
        }

        Role::create([
            'name' => 'admin',
            'display_name' => 'Admin',

        ]);

        Role::create([
            'name' => 'super-admin',
            'display_name' => 'Super Admin',

        ]);
        Role::create([
            'name' => 'super-user',
            'display_name' => 'Super User',

        ]);

        Role::create([
            'name' => 'teacher',
            'display_name' => 'Teacher',

        ]);


        User::factory(40)->create();

        User::factory()->create([
            'name' => 'Aziz',
            'email' => 'aziz@example.com',
        ]);

        User::factory()->create([
            'name' => 'Siyam',
            'email' => 'siyam@example.com',
        ]);

        User::factory()->create([
            'name' => 'Sakib',
            'email' => 'sakb@example.com',
        ]);

        User::factory()->create([
            'name' => 'Babul Mirdha',
            'email' => 'babul@example.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
