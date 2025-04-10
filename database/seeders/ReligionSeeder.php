<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $religions = [
            ['religion' => 'Islam'],
            ['religion' => 'Christianity'],
            ['religion' => 'Hinduism'],
            ['religion' => 'Buddhism'],
            ['religion' => 'Judaism'],
            ['religion' => 'Atheism'],
            ['religion' => 'Other'],
        ];

        DB::table('religions')->insert($religions);
    }
}
