<?php

namespace Database\Seeders;

use App\Models\RootDivide;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransportRootSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $routes = [
            [
                // 'serial_no' => 1,
                'year' => 2025,
                'assign_date' => '2025-07-05',
                'root_code' => 'RT-001',
                'vehicle_no' => 'DHK-1234',
                'vehicle_name' => 'School Van 1',
                'from' => 'Uttara',
                'to' => 'Gulshan',
                'fees_amount' => 1500,
                'driver_name' => 'Md. Rahim',
                'contact_no' => '01712345678',
                'remarks' => 'Morning route only',
                'status' => 1,
            ],
            [
                // 'serial_no' => 2,
                'year' => 2025,
                'assign_date' => '2025-07-06',
                'root_code' => 'RT-002',
                'vehicle_no' => 'DHK-5678',
                'vehicle_name' => 'School Bus 2',
                'from' => 'Mirpur',
                'to' => 'Banani',
                'fees_amount' => 1800,
                'driver_name' => 'Md. Karim',
                'contact_no' => '01812345678',
                'remarks' => 'Evening route available',
                'status' => 1,
            ]
        ];

        foreach ($routes as $route) {
            RootDivide::create($route);
        }
    }
}
