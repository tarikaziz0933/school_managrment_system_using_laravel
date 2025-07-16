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
        Schema::create('students_transport_assigns', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->year('year');

            $table->foreignUuid('student_id')->constrained('students')->onDelete('cascade');

            $table->foreignUuid('root_divide_id')->constrained('root_divides')->onDelete('cascade');

            $table->string('applicable_month');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['student_id', 'root_divide_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students_transport_assigns');
    }
};
