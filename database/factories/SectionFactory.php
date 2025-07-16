<?php
namespace Database\Factories;

use App\Models\Campus;
use App\Models\SchoolClass;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Section>
 */
class SectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    $total_boys = $this->faker->numberBetween(0, 50);
    $total_girls = 50 - $total_boys;

    $gender = null;
    if ($total_girls == 0) {
        $gender = "boys";
    } else if ($total_boys == 0) {
        $gender = "girls";
    }

    return [
        'name'          => $this->faker->unique()->word(), // ✅ unique name
        'gender'        => $gender,
        'campus_id'     => Campus::inRandomOrder()->value('id'),
        'class_id'      => SchoolClass::inRandomOrder()->value('id'),
        'total_boys'    => $total_boys,
        'total_girls'   => $total_girls,
    ];
}
}
