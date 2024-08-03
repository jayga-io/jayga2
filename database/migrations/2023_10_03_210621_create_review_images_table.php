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
        Schema::create('review_images', function (Blueprint $table) {
            $table->id('review_image_id');
            $table->bigInteger('review_id')->unsigned();
            $table->foreign('review_id')->references('review_id')->on('reviews')->onDelete('cascade');
            $table->string('review_filename');
            $table->string('review_targetlocation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_images');
    }
};
