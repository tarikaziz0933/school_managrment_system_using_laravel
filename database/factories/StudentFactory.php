<?php
namespace Database\Factories;

use App\Models\Campus;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dob         = fake()->dateTimeBetween('-20 years', '-5 years');
        $admitted_at = fake()->dateTimeBetween($dob, 'now');

        $campus = Campus::inRandomOrder()->first();

        return [
            'name'              => fake()->name(),
            // 'image' => fake()->imageUrl(),
            'admitted_at'       => $admitted_at,
            'registration_number'       => fake()->randomNumber(5, true),
            'academic_year'     => fake()->year(),
            'campus_id'         => $campus->id,
            'class_id'          => \App\Models\StudentClass::inRandomOrder()
                ->value('id'), // Change to your class model
            'group_id'          => \App\Models\Group::
                inRandomOrder()
                ->value('id'),
            'section_id'        => Section::
                where('campus_id', $campus->id)
                ->inRandomOrder()
                ->value('id'),
            'roll'              => fake()->numberBetween(1, 100),
            'gender'            => fake()->randomElement(['male', 'female', 'other']),
            'id_number'         => fake()->unique()->numberBetween(1000, 9999),
            'mobile'            => fake()->phoneNumber(),
            'email'             => fake()->safeEmail(),
            // 'fathers_image' => fake()->imageUrl(),
            // 'fathers_name' => fake()->name('male'),
            // 'fathers_occupation' => fake()->jobTitle(),
            // 'fathers_contact' => fake()->phoneNumber(),
            // 'mothers_image' => fake()->imageUrl(),
            // 'mothers_name' => fake()->name('female'),
            // 'mothers_occupation' => fake()->jobTitle(),
            // 'mothers_contact' => fake()->phoneNumber(),
            'dob'               => $dob->format('Y-m-d'),
            'religion_id'       => \App\Models\Religion::inRandomOrder()->value('id'),
            'blood_group_name'  => fake()->randomElement(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-']),
            // 'nationality' => fake()->country(),
            'nationality_id'    => \App\Models\Nationality::inRandomOrder()->value('id'),
            'birth_place_id'     => \App\Models\District::inRandomOrder()->value('id'),
            'prev_school'       => fake()->company(),
            'present_address'   => fake()->address(),
            'permanent_address' => fake()->address(),
            // 'characteristics' => json_encode([
            //     'height' => fake()->randomFloat(1, 4.5, 6.5) . ' ft',
            //     'weight' => fake()->numberBetween(30, 80) . ' kg',
            //     'vision' => fake()->randomElement(['normal', 'short-sighted', 'long-sighted']),
            // ]),
            'remarks'           => fake()->sentence(),
            'status'            => fake()->numberBetween(0, 1),
            'marks'             => fake()->numberBetween(0, 100),
            'created_at'        => now(),
            'updated_at'        => now(),
        ];
    }

}
