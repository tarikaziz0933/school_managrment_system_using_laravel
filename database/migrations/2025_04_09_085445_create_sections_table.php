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
        Schema::create('sections', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');

            $table->string('gender')->nullable();

            $table->uuid('campus_id')->nullable();
            $table->foreign('campus_id')->references('id')->on('campuses');

            $table->uuid('class_id')->nullable();
            $table->foreign('class_id')->references('id')->on('classes');

            $table->integer('total_boys')->nullable()->default(0);
            $table->integer('total_girls')->nullable()->default(0);


            $table->integer('status')->default();

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['name', 'class_id'], 'unique_section_name_class_id');
            $table->index(['class_id'], 'index_section_class_id');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
