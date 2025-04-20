<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('id_number')->unique();
            $table->string('name');
            $table->dateTime('admitted_at');
            $table->integer('registration_number')->nullable();
            $table->string('academic_year')->nullable();

            $table->uuid('campus_id')->nullable();
            $table->foreign('campus_id')->references('id')->on('campuses');

            $table->uuid('class_id')->nullable();
            $table->foreign('class_id')->references('id')->on('classes');

            $table->uuid('group_id')->nullable();
            $table->foreign('group_id')->references('id')->on('groups');

            $table->uuid('section_id')->nullable();
            $table->foreign('section_id')->references('id')->on('sections');

            $table->integer('roll')->nullable();
            $table->string('gender'); // Updated here

            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->date('dob')->nullable();


            $table->uuid('religion_id')->nullable();
            $table->foreign('religion_id')->references('id')->on('religions');

            $table->string('prev_school')->nullable();
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            // $table->json('characteristics')->nullable();
            $table->string('remarks')->nullable();
            $table->integer('status');
            $table->integer('marks')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
