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



        Schema::create('fee_setup_masters', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('fee_type_id')->constrained('fee_types')->onDelete('cascade');
            $table->foreignUuid('class_id')->constrained('classes')->onDelete('cascade');
            $table->foreignUuid('group_id')->nullable()->constrained('groups')->onDelete('cascade');

            $table->foreignUuid('payment_frequency_type_id')->constrained('payment_frequency_types')->onDelete('cascade');

            $table->double('amount')->default(0);

            $table->integer('year');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['fee_type_id', 'class_id', 'group_id', 'year']);
        });

        Schema::create('fee_setup_items', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->foreignUuid('fee_type_id')->constrained('fee_types')->onDelete('cascade');
            $table->foreignUuid('class_id')->constrained('classes')->onDelete('cascade');
            $table->foreignUuid('group_id')->nullable()->constrained('groups')->onDelete('cascade');

            $table->foreignUuid('fee_setup_master_id')->constrained('fee_setup_masters')->onDelete('cascade');

            $table->double('amount')->default(0);
            $table->integer('month')->nullable();
            $table->integer('year');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['fee_type_id', 'class_id', 'group_id', 'month', 'year'], 'yearly_fees_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_items');
        Schema::dropIfExists('fee_masters');

    }
};
