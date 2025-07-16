<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'street' => fake()->streetAddress(),
            // 'city' => fake()->city(),
            // 'state' => fake()->state(),
            // 'country' => fake()->country(),
            // 'zip_code' => fake()->postcode(),

            'address_type_slug' => fake()->randomElement(['home', 'work']),

            'addressable_id' => \Illuminate\Support\Facades\DB::table('students')
                ->inRandomOrder()
                ->value('id'),
            'addressable_type' => 'App\Models\Student',
        ];
    }
}
