<?php

namespace Database\Seeders;


use App\Models\Campus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Campus::create(['name'=>"Uttara Branch"]);
        Campus::create(['name'=>"Dhanmondi Branch"]);
        Campus::create(['name'=>"Banani Branch"]);
        Campus::create(['name'=>"Mirpur Branch"]);
        Campus::create(['name'=>"Shyamoli Branch"]);

    }
}
