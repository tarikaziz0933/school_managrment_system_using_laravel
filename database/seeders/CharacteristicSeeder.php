<?php

namespace Database\Seeders;

use App\Models\Characteristic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CharacteristicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $characterstics = [
            ['name' => 'Unsteady'],
            ['name' => 'Steady'],
            ['name' => 'Clever'],
            ['name' => 'Simple'],
            ['name' => 'Stubborn'],
            ['name' => 'Polite'],
        ];


        foreach ($characterstics as $item) {
           Characteristic::create($item);
        }
    }
}
