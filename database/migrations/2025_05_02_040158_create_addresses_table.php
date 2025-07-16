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
        Schema::create('addresses', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('address_line_1')->nullable();

            $table->string('area_name')->nullable();

            $table->uuid('police_station_id')->nullable();
            $table->foreign('police_station_id')->references('id')->on('police_stations');

            $table->uuid('district_id')->nullable();
            $table->foreign('district_id')->references('id')->on('districts');

            $table->string('country')->nullable();
            $table->string('zip_code')->nullable();

            $table->string('address_type_slug');

            $table->uuid('addressable_id');
            $table->string('addressable_type');

            $table->unique(['address_type_slug', 'addressable_id']);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
