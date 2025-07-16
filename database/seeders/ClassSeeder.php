<?php

namespace Database\Seeders;

use App\Models\SchoolClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // SchoolClass::factory(5)->create();

        $classes = [
            ['name' => 'Play','level' => -2],
            ['name' => 'Nursery', 'level' => -1],
            ['name' => 'KG', 'level' => 0],
            ['name' => 'One','level' => 1],
            ['name' => 'Two','level' => 2],
            ['name' => 'Three','level' => 3],
            ['name' => 'Four','level' => 4],
            ['name' => 'Five','level' => 5],
            ['name' => 'Six','level' => 6],
            ['name' => 'Seven','level' => 7],
            ['name' => 'Eight','level' => 8],
            ['name' => 'Nine','level' => 9],
            ['name' => 'Ten','level' => 10],

        ];

        foreach ($classes as $class) {
            SchoolClass::create($class);
        }

    }
}
