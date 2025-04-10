<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BirthPlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $birthPlaces = [
            ['name' => 'Bagerhat'],
            ['name' => 'Bandarban'],
            ['name' => 'Barguna'],
            ['name' => 'Barisal'],
            ['name' => 'Bhola'],
            ['name' => 'Bogra'],
            ['name' => 'Brahmanbaria'],
            ['name' => 'Chandpur'],
            ['name' => 'Chapai Nawabganj'],
            ['name' => 'Chattogram'],
            ['name' => 'Chuadanga'],
            ['name' => 'Comilla'],
            ['name' => 'Cox’s Bazar'],
            ['name' => 'Dhaka'],
            ['name' => 'Dinajpur'],
            ['name' => 'Faridpur'],
            ['name' => 'Feni'],
            ['name' => 'Gaibandha'],
            ['name' => 'Gazipur'],
            ['name' => 'Gopalganj'],
            ['name' => 'Habiganj'],
            ['name' => 'Jamalpur'],
            ['name' => 'Jashore'],
            ['name' => 'Jhalokati'],
            ['name' => 'Jhenaidah'],
            ['name' => 'Joypurhat'],
            ['name' => 'Khagrachari'],
            ['name' => 'Khulna'],
            ['name' => 'Kishoreganj'],
            ['name' => 'Kurigram'],
            ['name' => 'Kushtia'],
            ['name' => 'Lakshmipur'],
            ['name' => 'Lalmonirhat'],
            ['name' => 'Madaripur'],
            ['name' => 'Magura'],
            ['name' => 'Manikganj'],
            ['name' => 'Meherpur'],
            ['name' => 'Moulvibazar'],
            ['name' => 'Munshiganj'],
            ['name' => 'Mymensingh'],
            ['name' => 'Naogaon'],
            ['name' => 'Narail'],
            ['name' => 'Narayanganj'],
            ['name' => 'Narsingdi'],
            ['name' => 'Natore'],
            ['name' => 'Netrokona'],
            ['name' => 'Nilphamari'],
            ['name' => 'Noakhali'],
            ['name' => 'Pabna'],
            ['name' => 'Panchagarh'],
            ['name' => 'Patuakhali'],
            ['name' => 'Pirojpur'],
            ['name' => 'Rajbari'],
            ['name' => 'Rajshahi'],
            ['name' => 'Rangamati'],
            ['name' => 'Rangpur'],
            ['name' => 'Satkhira'],
            ['name' => 'Shariatpur'],
            ['name' => 'Sherpur'],
            ['name' => 'Sirajganj'],
            ['name' => 'Sunamganj'],
            ['name' => 'Sylhet'],
            ['name' => 'Tangail'],
            ['name' => 'Thakurgaon'],
        ];

        DB::table('birth_places')->insert($birthPlaces);
    }
}
