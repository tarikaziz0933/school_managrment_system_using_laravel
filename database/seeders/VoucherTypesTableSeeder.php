<?php

namespace Database\Seeders;

use App\Models\VoucherType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoucherTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $voucherTypes = [
            ['name' => 'payment', 'display_name' => 'Payment voucher', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'receipt', 'display_name' => 'Receipt voucher', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'journal', 'display_name' => 'Journal voucher', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($voucherTypes as $type) {
            VoucherType::create($type);
        }
    }
}
