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
        Schema::create('transport_collection_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('fee_collection_id')->constrained('fee_collections')->onDelete('cascade');
            $table->string('root_code_id')->nullable(); // or foreignUuid if you have a routes table
            $table->string('vehicle_name')->nullable();
            $table->double('amount')->default(0);
            $table->double('less')->default(0);
            $table->double('payable')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transport_collection_items');
    }
};
