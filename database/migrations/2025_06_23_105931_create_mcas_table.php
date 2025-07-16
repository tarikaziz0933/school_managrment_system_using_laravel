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
        Schema::create('mcas', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('mcaable_id');
            $table->string('mcaable_type');
            $table->unique(['mcaable_id', 'mcaable_type']); // unique per morph target

            $table->json('new_data')->nullable();

            $table->json('old_data')->nullable();

            $table->json('diff_data')->nullable();

            $table->enum('status', ['pending', 'checked', 'approved', 'rejected'])->default('pending');

            $table->dateTime('made_at')->nullable();
            $table->uuid('made_by')->nullable();

            $table->dateTime('modified_at')->nullable();
            $table->uuid('modified_by')->nullable();

            $table->dateTime('removed_at')->nullable();
            $table->uuid('removed_by')->nullable();

            $table->dateTime('checked_at')->nullable();
            $table->uuid('checked_by')->nullable();

            $table->dateTime('approved_at')->nullable();
            $table->uuid('approved_by')->nullable();


            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mcas');
    }
};
