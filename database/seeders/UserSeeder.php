<?php

namespace Database\Seeders;

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
        ]);
    }
}
