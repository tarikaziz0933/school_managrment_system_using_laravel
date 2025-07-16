<?php

namespace Database\Seeders;

use App\Models\Exam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exam_names = [
            ['name' => 'Degree'],
            ['name' => 'Honours'],
            ['name' => 'Masters'],
            ['name' => 'SSC'],
            ['name' => 'HSC'],
            ['name' => 'PASS COURSE'],
        ];


        foreach ($exam_names as $item) {
           Exam::create($item);
        }
    }
}
