<?php

namespace Database\Seeders;

use App\Models\RootDivide;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\StudentsTransportAssign;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentTransportAssignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $schoolClasses = SchoolClass::get();


        $rootDivides = RootDivide::all();

        foreach ($schoolClasses as $class) {

            $students = Student::whereHas("studentClasses", function ($q) use ($class) {
                $q->where("class_id", $class->id)
                    ->where("year", date('Y'));
            })->get();


            foreach ($students as $student) {

                StudentsTransportAssign::create([
                    'year' => now()->year,
                    'student_id' => $student->id,
                    'applicable_month' => now()->month,
                    'root_divide_id' => $rootDivides->random()->id,
                ]);
            }
        }
    }
}
