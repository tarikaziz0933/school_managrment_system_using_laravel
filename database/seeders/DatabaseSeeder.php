<?php

namespace Database\Seeders;

use App\Models\Campus;
use App\Models\RelationType;
use App\Models\Section;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);

        $this->call(CampusSeeder::class);
        $this->call(RelationTypeSeeder::class);
        $this->call(ReligionSeeder::class);
        $this->call(OccupationsTableSeeder::class);
        $this->call(NationalitiesTableSeeder::class);
        $this->call(DistrictsTableSeeder::class);
        $this->call(BloodGroupSeeder::class);
        $this->call(CharacteristicSeeder::class);
        $this->call(DesignationSeeder::class);
        $this->call(EmploymentTypeSeeder::class);
        $this->call(ExamSeeder::class);
        $this->call(EducationBoardSeeder::class);
        $this->call(NoticeSeeder::class);

        $this->call(ClassSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(SectionSeeder::class);

        $this->call(PaymentFrequencyTypeSeeder::class);

        $this->call(FeeTypeSeeder::class);



        $this->call(TransportRootSeeder::class);
        // $this->call(FeeSeeder::class);

        $this->call(EmployeeSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(StudentTransportAssignSeeder::class);

        $this->call(VoucherTypesTableSeeder::class);
    }
}
