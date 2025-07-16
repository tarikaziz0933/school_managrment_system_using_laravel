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
        Schema::create('vouchers', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('voucher_no', 16);
            $table->dateTime('voucher_at');

            $table->foreignUuid('voucher_type_id')
                ->constrained('voucher_types')
                ->onUpdate('cascade');

            $table->string('description', 100)->nullable();

            $table->decimal('amount', 10, 2)->nullable();

            $table->string('currency', 3)->default('BDT');

            $table->uuid('voucherable_id');
            $table->string('voucherable_type');

            $table->string('sourceable_type')->nullable();
            $table->uuid('sourceable_id')->nullable();

            $table->dateTime('approved_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
