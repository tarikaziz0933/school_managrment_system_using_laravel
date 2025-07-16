<?php

namespace Database\Seeders;

use App\Models\Campus;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\EmploymentType;
use App\Models\Nationality;
use App\Models\Religion;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            Employee::create([
                'id' => Str::uuid(),
                'id_number' => Employee::generateEmployeeId(Carbon::now()),
                'name' => $faker->name,
                'joined_at' => $faker->date(),

                'designation_id' => Designation::inRandomOrder()->value('id'),
                'campus_id' => Campus::inRandomOrder()->value('id'),
                'religion_id' => Religion::inRandomOrder()->value('id'),
                'nationality_id' => Nationality::inRandomOrder()->value('id'),
                'blood_group_name' => $faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']),

                'employment_type_id' => EmploymentType::inRandomOrder()->value('id'),
                'status' => 1,
                'entry_date' => $faker->date(),
                'father_name' => $faker->name('male'),
                'mother_name' => $faker->name('female'),
                'marital_status' => $faker->randomElement(['married', 'un_married']),
                'spouse_name' => $faker->optional()->name,
                'spouse_mobile' => $faker->optional()->phoneNumber,
                'no_of_child' => $faker->optional()->numberBetween(0, 5),
                'dob' => $faker->date(),
                'gender' => $faker->randomElement(['male', 'female', 'other']),
                'NID_BRN_no' => $faker->unique()->numerify('##########'),
                'mobile' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'NTRCA_reg_number' => 'NTRCA-' . $faker->unique()->numerify('########'),
                'NTRCA_subject' => implode(', ', $faker->randomElements(['reading', 'traveling', 'music', 'sports'], 2)),

                'experience' => $faker->sentence,
                'reference' => $faker->name,
                'computer_knowledge' => $faker->randomElement(['Basic', 'Intermediate', 'Advanced']),
                'salary' => $faker->randomFloat(2, 20000, 100000),
            ]);
        }
    }
}
