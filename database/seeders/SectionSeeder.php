<?php

namespace Database\Seeders;

use App\Models\Campus;
use App\Models\SchoolClass;
use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $campuses = Campus::all();
        $classes = SchoolClass::all();

        foreach ($campuses as $campus) {
            foreach ($classes as $class) {
                Section::factory()->create([
                    'campus_id' => $campus->id,
                    'class_id'  => $class->id,
                ]);
            }
        }
    }
}
