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
        Schema::create('characteristics', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 50)->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('student_characteristics', function (Blueprint $table) {
            $table->uuid('student_id');

            $table->foreign('student_id')->references('id')->on('students')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->uuid('characteristic_id');
            $table->foreign('characteristic_id')->references('id')->on('characteristics')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['student_id', 'characteristic_id']);
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_characteristics');
        Schema::dropIfExists('characteristics');
    }
};
