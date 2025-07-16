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
            Schema::create('payment_frequency_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->unique();
            $table->string('display_name')->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('fee_types', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->integer('code')->unique();

            $table->string('name')->unique();

            $table->string('description')->nullable();

            $table->foreignUuid('payment_frequency_type_id')
                ->constrained('payment_frequency_types')
                ->onDelete('cascade');

            $table->integer('status')->default();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_types');
        Schema::dropIfExists('payment_frequency_types');
    }
};
