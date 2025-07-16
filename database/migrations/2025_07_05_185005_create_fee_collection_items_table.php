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
        Schema::create('fee_collection_items', function (Blueprint $table) {
            $table->uuid('id')->primary();


            $table->double('fee_amount')->default(0);
            $table->double('less')->default(0);
            $table->double('payable')->default(0);

            $table->foreignUuid('fee_type_id')->constrained('fee_types')->cascadeOnDelete();

            $table->foreignUuid('fee_setup_item_id')->constrained('fee_setup_items')->onDelete('cascade');

            $table->foreignUuid('fee_collection_id')->constrained('fee_collections')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_collection_items');
    }
};
