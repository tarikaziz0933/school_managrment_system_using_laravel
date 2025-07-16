<?php
namespace Database\Seeders;

use App\Models\RelationType;
use Illuminate\Database\Seeder;

class RelationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [

            [
                'slug' => RelationType::FATHER,
                'name' => 'Father',
            ],
            [
                'slug' => RelationType::MOTHER,
                'name' => 'Mother'
            ],
            [
                'slug' => RelationType::BORTHER,
                'name' => 'Brother'
            ],
            [
                'slug' => RelationType::SISTER,
                'name' => 'Sister'
            ],
            [
                'slug' => RelationType::UNCLE,
                'name' => 'Uncle'
            ],
        ];

        foreach ($items as $item) {
            RelationType::create($item);
        }
    }
}
