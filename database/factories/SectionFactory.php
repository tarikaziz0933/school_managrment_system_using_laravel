<?php

namespace Database\Factories;

use App\Models\Campus;
use App\Models\StudentClass;
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
        return [
           'name' => $this->faker->word,
           'gender'=> $this->faker->randomElement(['male', 'female', null]),
           'campus_id' => Campus::factory(),
           'class_id'  => StudentClass::factory(),
        ];
    }
}
