<?php

namespace Database\Seeders;

use App\Models\Nationality;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NationalitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nationalities = [
            ['name' => 'Afghan'],
            ['name' => 'Albanian'],
            ['name' => 'Algerian'],
            ['name' => 'American'],
            ['name' => 'Andorran'],
            ['name' => 'Angolan'],
            ['name' => 'Argentine'],
            ['name' => 'Armenian'],
            ['name' => 'Australian'],
            ['name' => 'Austrian'],
            ['name' => 'Azerbaijani'],
            ['name' => 'Bangladeshi'],
            ['name' => 'Belgian'],
            ['name' => 'Brazilian'],
            ['name' => 'British'],
            ['name' => 'Bulgarian'],
            ['name' => 'Canadian'],
            ['name' => 'Chilean'],
            ['name' => 'Chinese'],
            ['name' => 'Colombian'],
            ['name' => 'Cuban'],
            ['name' => 'Danish'],
            ['name' => 'Dutch'],
            ['name' => 'Egyptian'],
            ['name' => 'Emirati'],
            ['name' => 'English'],
            ['name' => 'Finnish'],
            ['name' => 'French'],
            ['name' => 'Georgian'],
            ['name' => 'German'],
            ['name' => 'Greek'],
            ['name' => 'Hungarian'],
            ['name' => 'Icelandic'],
            ['name' => 'Indian'],
            ['name' => 'Indonesian'],
            ['name' => 'Iranian'],
            ['name' => 'Iraqi'],
            ['name' => 'Irish'],
            ['name' => 'Israeli'],
            ['name' => 'Italian'],
            ['name' => 'Japanese'],
            ['name' => 'Jordanian'],
            ['name' => 'Kenyan'],
            ['name' => 'Kuwaiti'],
            ['name' => 'Lebanese'],
            ['name' => 'Libyan'],
            ['name' => 'Malaysian'],
            ['name' => 'Mexican'],
            ['name' => 'Moroccan'],
            ['name' => 'Nepalese'],
            ['name' => 'New Zealander'],
            ['name' => 'Nigerian'],
            ['name' => 'Norwegian'],
            ['name' => 'Pakistani'],
            ['name' => 'Palestinian'],
            ['name' => 'Peruvian'],
            ['name' => 'Philippine'],
            ['name' => 'Polish'],
            ['name' => 'Portuguese'],
            ['name' => 'Qatari'],
            ['name' => 'Romanian'],
            ['name' => 'Russian'],
            ['name' => 'Saudi'],
            ['name' => 'Scottish'],
            ['name' => 'Singaporean'],
            ['name' => 'South African'],
            ['name' => 'South Korean'],
            ['name' => 'Spanish'],
            ['name' => 'Sri Lankan'],
            ['name' => 'Sudanese'],
            ['name' => 'Swedish'],
            ['name' => 'Swiss'],
            ['name' => 'Syrian'],
            ['name' => 'Tanzanian'],
            ['name' => 'Thai'],
            ['name' => 'Tunisian'],
            ['name' => 'Turkish'],
            ['name' => 'Ukrainian'],
            ['name' => 'Uruguayan'],
            ['name' => 'Venezuelan'],
            ['name' => 'Vietnamese'],
            ['name' => 'Welsh'],
            ['name' => 'Yemeni'],
        ];


        foreach ($nationalities as $item) {
            Nationality::create($item);
         }
    }
}
