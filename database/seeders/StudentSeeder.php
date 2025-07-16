<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Campus;
use App\Models\Group;
use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\StudentClass;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schoolClasses = SchoolClass::all();

        foreach ($schoolClasses as $schoolClass) {
            $section = Section::where('class_id', $schoolClass->id)->inRandomOrder()->first();

            if (!$section) {
                continue; // skip if no section
            }

            $section_id = $section->id;
            $campus_id = $section->campus?->id;

            for ($i = 0; $i < 40; $i++) {
                $student = Student::factory()->create();

                \App\Models\Guardian::factory()->create([
                    'guardianable_id' => $student->id,
                    'guardianable_type' => Student::class,
                    'relation_type_slug' => 'father',
                ]);

                \App\Models\Guardian::factory()->create([
                    'guardianable_id' => $student->id,
                    'guardianable_type' => Student::class,
                    'relation_type_slug' => 'mother',
                ]);

                $group = Group::inRandomOrder()->first();

                StudentClass::create([
                    'student_id' => $student->id,
                    'class_id' => $schoolClass->id,
                    'section_id' => $section_id,
                    'campus_id' => $campus_id,
                    'group_id' => $schoolClass->level >= 9 ? $group?->id : null,
                    'roll' => $i + 1,
                    'year' => 2025,
                ]);

            }
        }
    }
}

