<?php

namespace Database\Seeders;

use App\Models\Designation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $designations = [
            ['name' => 'Accounce Officer'],
            ['name' => 'Assistant Teacher'],
            ['name' => 'Computer Operator'],
            ['name' => 'Incharge'],
            ['name' => 'Principle'],
            ['name' => 'Security Guard'],
            ['name' => 'Supervisor'],
            ['name' => 'Van Driver'],
            ['name' => 'Vice-Principle'],

        ];

        foreach ($designations as $item) {
            Designation::create($item);
        }
    }
}
