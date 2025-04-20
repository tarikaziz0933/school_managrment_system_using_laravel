<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guardian>
 */
class GuardianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'              => fake()->name(),
            'relation_slug'          => fake()->randomElement(['father', 'mother']),
            'occupation_id'        => \Illuminate\Support\Facades\DB::table('occupations')
                ->inRandomOrder()
                ->value('id'),
            'mobile'            => fake()->phoneNumber(),
            'student_id'         => \Illuminate\Support\Facades\DB::table('students')
                ->inRandomOrder()
                ->value('id'),
        ];
    }
}
