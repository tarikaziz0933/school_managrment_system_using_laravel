<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $class_ids = StudentClass::pluck('id');
        foreach ($class_ids as $id) {
            // Create 10 students for each class
            Student::factory(40)->create([
                'class_id' => $id,
            ]);
        }

        $student_ids = Student::pluck('id');

        foreach ($student_ids as $student_id) {

            // Create 2 guardians for each student


            \App\Models\Guardian::factory()->create([
                'student_id' => $student_id,
                'relation_slug' => 'father',
            ]);


            \App\Models\Guardian::factory()->create([
                'student_id' => $student_id,
                'relation_slug' => 'mother',
            ]);
        }


    }
}
