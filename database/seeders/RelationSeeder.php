<?php
namespace Database\Seeders;

use App\Models\Relation;
use Illuminate\Database\Seeder;

class RelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [

            [
                'slug' => 'father',
                'name' => 'Father',
            ],
            [
                'slug' => 'mother',
                'name' => 'Mother'],
        ];

        foreach ($items as $item) {
            Relation::create($item);
        }
    }
}
