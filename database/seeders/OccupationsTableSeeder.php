<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OccupationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $occupations = [
            ['name' => 'Accountant'],
            ['name' => 'Architect'],
            ['name' => 'Artist'],
            ['name' => 'Businessperson'],
            ['name' => 'Carpenter'],
            ['name' => 'Chef'],
            ['name' => 'Cleaner'],
            ['name' => 'Clerk'],
            ['name' => 'Consultant'],
            ['name' => 'Dentist'],
            ['name' => 'Doctor'],
            ['name' => 'Driver'],
            ['name' => 'Electrician'],
            ['name' => 'Engineer'],
            ['name' => 'Farmer'],
            ['name' => 'Fashion Designer'],
            ['name' => 'Firefighter'],
            ['name' => 'Hairdresser'],
            ['name' => 'Journalist'],
            ['name' => 'Lawyer'],
            ['name' => 'Lecturer'],
            ['name' => 'Librarian'],
            ['name' => 'Mechanic'],
            ['name' => 'Military'],
            ['name' => 'Musician'],
            ['name' => 'Nurse'],
            ['name' => 'Painter'],
            ['name' => 'Pharmacist'],
            ['name' => 'Photographer'],
            ['name' => 'Pilot'],
            ['name' => 'Plumber'],
            ['name' => 'Police Officer'],
            ['name' => 'Politician'],
            ['name' => 'Professor'],
            ['name' => 'Receptionist'],
            ['name' => 'Scientist'],
            ['name' => 'Security Guard'],
            ['name' => 'Software Developer'],
            ['name' => 'Student'],
            ['name' => 'Teacher'],
            ['name' => 'Technician'],
            ['name' => 'Translator'],
            ['name' => 'Veterinarian'],
            ['name' => 'Waiter'],
            ['name' => 'Writer'],
            ['name' => 'Unemployed'],
            ['name' => 'Homemaker'],
            ['name' => 'Retired'],
            ['name' => 'Other'],
        ];

        DB::table('occupations')->insert($occupations);
    }
}
