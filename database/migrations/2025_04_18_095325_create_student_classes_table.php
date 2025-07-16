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
        Schema::create('student_classes', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->uuid('student_id');
            $table->foreign('student_id')->references('id')->on('students');

            $table->uuid('class_id')->nullable();
            $table->foreign('class_id')->references('id')->on('classes');

            $table->string('year');

            $table->uuid('campus_id')->nullable();
            $table->foreign('campus_id')->references('id')->on('campuses');


            $table->uuid('group_id')->nullable();
            $table->foreign('group_id')->references('id')->on('groups');

            $table->uuid('section_id')->nullable();
            $table->foreign('section_id')->references('id')->on('sections');

            $table->integer('roll')->nullable();
            $table->string('roll_postfix',1)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['student_id','class_id', 'year']);
            // $table->unique(['student_id','class_id', 'year', 'roll', 'roll_postfix']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_classes');
    }
};
