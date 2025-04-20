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
        Schema::create('employees', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('id_number')->unique();
            $table->string('name');
            $table->date('admitted_at');

            $table->uuid('designation_id')->nullable();
            $table->foreign('designation_id')->references('id')->on('designations')->onDelete('set null');

            $table->uuid('campus_id')->nullable();
            $table->foreign('campus_id')->references('id')->on('campuses')->onDelete('set null');

            $table->uuid('religion_id')->nullable();
            $table->foreign('religion_id')->references('id')->on('religions')->onDelete('set null');

            $table->uuid('nationality_id')->nullable();
            $table->foreign('nationality_id')->references('id')->on('nationalities')->onDelete('set null');
            
            $table->string('blood_group_name')->nullable();
            $table->foreign('blood_group_name')->references('name')->on('blood_groups')->onUpdate('cascade')->onDelete('set null');

            $table->string('type')->nullable(); // permanent, part_time, other
            $table->boolean('status')->default(1); // 0 = inactive, 1 = active
            $table->date('entry_date')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('marital_status')->nullable(); // married, un_married
            $table->string('spouse_name')->nullable();
            $table->string('spouse_mobile')->nullable();
            $table->integer('no_of_child')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable(); // male, female, other
            $table->string('NID_no')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('hobbies')->nullable();
            $table->string('experience')->nullable();
            $table->string('reference')->nullable();
            $table->string('computer_knowledge')->nullable();
            $table->decimal('salary', 10, 2)->nullable();

            // Image (assuming you store a reference to an image table or a path)

            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraints (optional)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
