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

            $table->string('name');
            $table->string('name_bn')->nullable();
            $table->enum('version', ['bangla', 'english']);

            $table->dateTime('admitted_at');

            $table->integer('id_number')->unique();
            $table->string('govt_uid_number')->unique()->nullable();

            $table->string('gender'); // Updated here

            $table->string('mobile')->nullable();

            $table->string('brn')->nullable();
            $table->string('sms_number')->nullable();

            $table->string('email')->nullable();
            $table->date('dob')->nullable();


            $table->uuid('religion_id')->nullable();
            $table->foreign('religion_id')->references('id')->on('religions');

            $table->string('prev_school')->nullable();
            // $table->text('present_address')->nullable();
            // $table->text('permanent_address')->nullable();
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
