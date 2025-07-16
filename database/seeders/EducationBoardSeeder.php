<?php

namespace Database\Seeders;

use App\Models\EducationBoard;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationBoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $boards = [
            ['name' => 'Dhaka'],
            ['name' => 'Rajshahi'],
            ['name' => 'Chittagong'],
            ['name' => 'Khulna'],
            ['name' => 'Barisal'],
            ['name' => 'Sylhet'],
            ['name' => 'Comilla'],
            ['name' => 'Jessore'],
            ['name' => 'Mymensingh'],
            ['name' => 'Madrasah'],
            ['name' => 'Technical'],
            ['name' => 'National University'],
        ];

        foreach ($boards as $item) {
            EducationBoard::create($item);
         }
    }
}
