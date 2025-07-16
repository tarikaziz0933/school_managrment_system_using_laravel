<?php

namespace Database\Seeders;

use App\Models\FeeType;
use App\Models\PaymentFrequencyType;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FeeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fees = [
            ['code' => 601, 'name' => 'Admission Fee', 'payment_frequency_type_id' =>  PaymentFrequencyType::where('name', 'one_time')->first()->id] ,
            ['code' => 602, 'name' => 'Session Charge', 'payment_frequency_type_id' => PaymentFrequencyType::where('name', PaymentFrequencyType::PAYMENT_FREQUENCY_TYPE_YEARLY)->first()->id],
            ['code' => 603, 'name' => 'Tuition Fee', 'payment_frequency_type_id' => PaymentFrequencyType::where('name', PaymentFrequencyType::PAYMENT_FREQUENCY_TYPE_MONTHLY)->first()->id],
            ['code' => 604, 'name' => 'Exam Fee (1st Tutorial)', 'payment_frequency_type_id' => PaymentFrequencyType::where('name', PaymentFrequencyType::PAYMENT_FREQUENCY_TYPE_QUARTERLY)->first()->id],
            ['code' => 605, 'name' => 'Exam Fee (1st Term)', 'payment_frequency_type_id' => PaymentFrequencyType::where('name', PaymentFrequencyType::PAYMENT_FREQUENCY_TYPE_QUARTERLY)->first()->id],
            ['code' => 606, 'name' => 'Exam Fee (2nd Tutorial)', 'payment_frequency_type_id' => PaymentFrequencyType::where('name', PaymentFrequencyType::PAYMENT_FREQUENCY_TYPE_QUARTERLY)->first()->id],
            ['code' => 607, 'name' => 'Exam Fee (2nd Term)', 'payment_frequency_type_id' => PaymentFrequencyType::where('name', PaymentFrequencyType::PAYMENT_FREQUENCY_TYPE_QUARTERLY)->first()->id],
            ['code' => 608, 'name' => 'Exam Fee (3rd Tutorial)', 'payment_frequency_type_id' => PaymentFrequencyType::where('name', PaymentFrequencyType::PAYMENT_FREQUENCY_TYPE_QUARTERLY)->first()->id],
            ['code' => 609, 'name' => 'Exam Fee (Final)', 'payment_frequency_type_id' => PaymentFrequencyType::where('name', PaymentFrequencyType::PAYMENT_FREQUENCY_TYPE_YEARLY)->first()->id],
            ['code' => 610, 'name' => 'ID Card Fee', 'payment_frequency_type_id' => PaymentFrequencyType::where('name', PaymentFrequencyType::PAYMENT_FREQUENCY_TYPE_YEARLY)->first()->id],
            ['code' => 611, 'name' => 'Exam Fee (Half Yearly)', 'payment_frequency_type_id' => PaymentFrequencyType::where('name', PaymentFrequencyType::PAYMENT_FREQUENCY_TYPE_HALF_YEARLY)->first()->id],
            ['code' => 612, 'name' => 'First Model Test', 'payment_frequency_type_id' => PaymentFrequencyType::where('name', PaymentFrequencyType::PAYMENT_FREQUENCY_TYPE_QUARTERLY)->first()->id],
            ['code' => 613, 'name' => 'Final Model Test', 'payment_frequency_type_id' => PaymentFrequencyType::where('name', PaymentFrequencyType::PAYMENT_FREQUENCY_TYPE_YEARLY)->first()->id],
            ['code' => 614, 'name' => 'Teachers Welfare Fund', 'payment_frequency_type_id' => PaymentFrequencyType::where('name', PaymentFrequencyType::PAYMENT_FREQUENCY_TYPE_YEARLY)->first()->id],
            ['code' => 615, 'name' => 'Half Yearly Assessment', 'payment_frequency_type_id' => PaymentFrequencyType::where('name', PaymentFrequencyType::PAYMENT_FREQUENCY_TYPE_HALF_YEARLY)->first()->id],
            ['code' => 616, 'name' => 'Library Fee', 'payment_frequency_type_id' => PaymentFrequencyType::where('name', PaymentFrequencyType::PAYMENT_FREQUENCY_TYPE_MONTHLY)->first()->id],
            ['code' => 617, 'name' => 'Laboratory Fee', 'payment_frequency_type_id' => PaymentFrequencyType::where('name', PaymentFrequencyType::PAYMENT_FREQUENCY_TYPE_MONTHLY)->first()->id],
            ['code' => 618, 'name' => 'Sports Fee', 'payment_frequency_type_id' => PaymentFrequencyType::where('name', PaymentFrequencyType::PAYMENT_FREQUENCY_TYPE_QUARTERLY)->first()->id],
            ['code' => 619, 'name' => 'Development Fee', 'payment_frequency_type_id' => PaymentFrequencyType::where('name', PaymentFrequencyType::PAYMENT_FREQUENCY_TYPE_YEARLY)->first()->id],
            ['code' => 620, 'name' => 'Transport Fee', 'payment_frequency_type_id' => PaymentFrequencyType::where('name', PaymentFrequencyType::PAYMENT_FREQUENCY_TYPE_MONTHLY)->first()->id],
        ];

        foreach ($fees as $fee) {


            FeeType::create([

                'code' => $fee['code'],
                'name' => $fee['name'],
                'description' => $fee['name'],
                'payment_frequency_type_id' => $fee['payment_frequency_type_id'] ?? null,
                'status' => 1,
            ]);


        }


    }
}
