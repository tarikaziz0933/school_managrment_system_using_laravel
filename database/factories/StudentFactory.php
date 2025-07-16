<?php
namespace Database\Factories;

use App\Models\Campus;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $dob = fake()->dateTimeBetween('-20 years', '-5 years');
        $admitted_at = fake()->dateTimeBetween($dob, 'now');

        return [
            'name' => fake()->name(),
            'version' => $this->faker->randomElement(['bangla', 'english']),


            'admitted_at' => $admitted_at,

            'gender' => fake()->randomElement(['male', 'female', 'other']),
            'id_number' => Student::generateStudentId(),
            'govt_uid_number' => 'UID-' . strtoupper(Str::random(6)),
            'mobile' => fake()->phoneNumber(),
            'sms_number' => fake()->phoneNumber(),
            'email' => fake()->safeEmail(),

            'dob' => $dob->format('Y-m-d'),
            'religion_id' => \App\Models\Religion::inRandomOrder()->value('id'),
            'blood_group_name' => fake()->randomElement(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-']),

            'nationality_id' => \App\Models\Nationality::inRandomOrder()->value('id'),
            'birth_place_id' => \App\Models\District::inRandomOrder()->value('id'),
            'prev_school' => fake()->company(),
            'remarks' => fake()->sentence(),
            'status' => fake()->numberBetween(0, 1),
            'marks' => fake()->numberBetween(0, 100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
