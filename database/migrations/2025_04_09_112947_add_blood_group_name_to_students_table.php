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
        Schema::table('students', function (Blueprint $table) {
            $table->string('blood_group_name')->nullable();

            // Ensure blood_groups.name is indexed/unique before applying this
            $table->foreign('blood_group_name')
                  ->references('name')
                  ->on('blood_groups')
                  ->onUpdate('cascade')
                  ->onDelete('set null'); // or restrict/cascade depending on your logic
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['blood_group_name']);
            $table->dropColumn('blood_group_name');
        });
    }
};
