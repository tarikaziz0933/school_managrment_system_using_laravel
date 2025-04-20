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
        Schema::table('guardians', function (Blueprint $table) {
            $table->string('relation_slug')->nullable()->after('student_id');

            $table->foreign('relation_slug')->references('slug')->on('relations')->onDelete('set null');

            // Make sure student_id column exists before this line
            $table->unique(['student_id', 'relation_slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guardians', function (Blueprint $table) {
            // Drop unique constraint
            $table->dropUnique(['student_id', 'relation_id']);

            // Drop foreign key and column
            $table->dropForeign(['relation_id']);
            $table->dropColumn('relation_id');
        });
    }
};

