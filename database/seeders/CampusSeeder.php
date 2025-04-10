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
        // Branch::factory(5)->create();

        Campus::create(['name'=>"Uttara Branch"]);
        Campus::create(['name'=>"Dhanbondi Branch"]);
        Campus::create(['name'=>"Banani Branch"]);
        
    }
}
