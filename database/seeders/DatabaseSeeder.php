<?php

namespace Database\Seeders;

use App\Models\Campus;
use App\Models\Relation;
use App\Models\Section;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RelationSeeder::class);
        $this->call(ReligionSeeder::class);
        $this->call(OccupationsTableSeeder::class);
        $this->call(NationalitiesTableSeeder::class);
        $this->call(BirthPlacesTableSeeder::class);
        $this->call(BloodGroupSeeder::class);
        $this->call(CampusSeeder::class);
        $this->call(ClassSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(SectionSeeder::class);

       $this->call(UserSeeder::class);
       $this->call(StudentSeeder::class);
       
    }
}
