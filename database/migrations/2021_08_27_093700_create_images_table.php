<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->string('caption')->nullable();
            $table->string('alt')->nullable();
            $table->string('type')->nullable();
            $table->string('size')->nullable();
            $table->string('disk')->nullable();
            $table->string('path')->nullable();
            $table->string('url')->nullable();

            $table->string('extension')->nullable();

            $table->uuid('imageable_id')->nullable();
            $table->string('imageable_type')->nullable();

            $table->timestamps();
            $table->softDeletes();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
