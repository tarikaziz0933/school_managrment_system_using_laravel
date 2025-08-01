<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Group::factory(10)->create();

        $groups = [
            ['name' => 'Science'],
            ['name' => 'Arts'],
            ['name' => 'Commerce'],
        ];
        foreach ($groups as $group) {
            Group::create($group);
        }


    }
}
