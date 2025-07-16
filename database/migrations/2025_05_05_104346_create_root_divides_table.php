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
        Schema::create('root_divides', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->year('year');
            $table->date('assign_date');
            $table->string('root_code')->nullable();
            $table->string('vehicle_no')->nullable()->unique();
            $table->string('vehicle_name')->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->decimal('fees_amount', 10, 2)->nullable();
            $table->string('driver_name')->nullable();
            $table->string('contact_no')->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('root_divides');
    }
};
