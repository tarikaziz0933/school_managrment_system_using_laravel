<?php

namespace Database\Seeders;

use App\Models\FeeType;
use App\Models\SchoolClass;
use App\Models\Fee;
use App\Models\FeeItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeeSetupMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $year = 2025;
        $groupId = null;

        $classFrom = SchoolClass::first(); // Replace with specific class if needed
        $classTo = SchoolClass::orderByDesc('level')->first();

        // if (!$classFrom || !$classTo) {
        //     dump('Class range not found. Seeder stopped.');
        //     return;
        // }

        $feeTypes = FeeType::take(15)->get();
        // if ($feeTypes->isEmpty()) {
        //     dump('No Fee Types found. Seeder stopped.');
        //     return;
        // }

        $formLevel = $classFrom->level;
        $toLevel = $classTo->level;

        $classLevels = SchoolClass::whereBetween('level', [$formLevel, $toLevel])->get();

        foreach ($classLevels as $class) {
            foreach ($feeTypes as $feeType) {

                  $master = FeeSetupMaster::create([
                        'class_id' => $class->id,
                        'group_id' => $groupId,
                        'year' => $year,
                        'fee_type_id' => $feeType->id,
                        'amount' => rand(500, 1000),
                    ]);

                    FeeItem::create([
                        'class_id' => $class->id,
                        'group_id' => $groupId,
                        'year' => $year,
                        'fee_type_id' => $feeType->id,
                        'amount' => rand(500, 1000),
                        ''
                    ]);

            }
        }

        // dump('Yearly fees seeded successfully.');
    }
}
