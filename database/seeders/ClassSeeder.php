<?php

namespace Database\Seeders;

use App\Models\StudentClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // StudentClass::factory(5)->create();

        $classes = [
            ['name' => 'Play'],
            ['name' => 'Nursery'],
            ['name' => 'KG'],
            ['name' => 'One'],
            ['name' => 'Two'],
            ['name' => 'Three'],
            ['name' => 'Fouth'],
            ['name' => 'Five'],
            ['name' => 'Six'],
            ['name' => 'Seven'],
            ['name' => 'Eight'],
            ['name' => 'Nine'],

        ];

        foreach ($classes as $class) {
            StudentClass::create($class);
        }

    }
}
