<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('exam_id')->nullable()->constrained('exams');
            $table->foreignUuid('group_id')->nullable()->constrained('groups');
            $table->foreignUuid('education_board_id')->nullable()->constrained('education_boards');
            $table->integer('passing_year')->nullable();
            $table->string('result')->nullable();

            $table->uuid('educationable_id')->nullable();
            $table->string('educationable_type')->nullable();

            $table->unique(['educationable_id', 'exam_id']);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
