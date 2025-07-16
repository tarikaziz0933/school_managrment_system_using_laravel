<?php

namespace Database\Seeders;


use App\Models\PaymentFrequencyType;
use Illuminate\Database\Seeder;

class PaymentFrequencyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $items = [
            [
                'name' => 'one_time',
                'display_name' => 'One Time',
            ],

            [
                'name' => 'monthly',
                'display_name' => 'Monthly',
            ],
            [
                'name' => 'quarterly',
                'display_name' => 'Quarterly',
            ],
            [
                'name' => 'half_yearly',
                'display_name' => 'Half Yearly',
            ],
            [
                'name' => 'yearly',
                'display_name' => 'Yearly',
            ],
        ];

        foreach ($items as $item) {
            PaymentFrequencyType::create($item);
        }


    }
}
