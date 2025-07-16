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
        Schema::create('fee_payment_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('fee_collection_id');
            $table->foreign('fee_collection_id')->references('id')->on('fee_collections')->onDelete('cascade');

            // Payment method info
            $table->string('paid_by');
            $table->string('cheque_no')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('address')->nullable();
            $table->text('remarks')->nullable();

            // Amounts
            $table->decimal('total_payable', 10, 2);
            $table->decimal('fine_amount', 10, 2)->default(0);
            $table->decimal('grand_total', 10, 2);
            $table->decimal('less_amount', 10, 2)->default(0);
            $table->decimal('total_payable_amount', 10, 2);
            $table->decimal('paid_amount', 10, 2);
            $table->decimal('due_amount', 10, 2)->nullable();
            $table->decimal('return_amount', 10, 2)->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_payment_details');
    }
};
