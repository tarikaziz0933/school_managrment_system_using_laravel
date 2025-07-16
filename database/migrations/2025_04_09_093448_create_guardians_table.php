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
        Schema::create('guardians', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name');
            $table->string('name_bn')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('dob')->nullable();
            $table->string('nid')->nullable();

            $table->boolean('is_primary_guardian')->default(false);

            $table->string('relation_type_slug')->nullable();

            $table->uuid('occupation_id')->nullable();
            $table->foreign('occupation_id')->references('id')->on('occupations');

            $table->uuid('guardianable_id');
            $table->string('guardianable_type');


            $table->unique(['guardianable_id', 'relation_type_slug']);

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guardians');
    }
};
