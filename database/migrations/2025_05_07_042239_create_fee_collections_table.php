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
        Schema::create('fee_collections', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('collection_no')->nullable()->unique();
            $table->dateTime('collected_at')->nullable();
            $table->integer('applicable_year');

            $table->decimal('total_amount', 10, 2)->default(0);
            $table->decimal('fine_amount', 10, 2)->default(0);
            $table->decimal('grand_total', 10, 2)->default(0); // fixed typo
            $table->decimal('less_amount', 10, 2)->default(0);
            $table->decimal('total_payable_amount', 10, 2)->default(0);
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->decimal('due_amount', 10, 2)->default(0);

            $table->foreignUuid('student_id')->constrained('students')->onDelete('cascade');

            $table->dateTime('approved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_collections');
    }
};
