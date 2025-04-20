<?php

namespace Database\Seeders;

use App\Models\Relation;
use App\Models\Religion;
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
            ['name' => 'Islam'],
            ['name' => 'Christianity'],
            ['name' => 'Hinduism'],
            ['name' => 'Buddhism'],
            ['name' => 'Judaism'],
            ['name' => 'Other'],
        ];


        foreach ($religions as $religion) {
           Religion::create($religion);
        }

    }
}
