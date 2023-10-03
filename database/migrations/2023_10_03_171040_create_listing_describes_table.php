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
        Schema::create('listing_describes', function (Blueprint $table) {
            $table->id('listing_id');
            $table->foreign('listing_id')->references('listing_id')->on('listings')->onDelete('cascade');
            $table->integer('apartments');
            $table->integer('cabin');
            $table->integer('lounge');
            $table->integer('farm');
            $table->integer('campsite');
            $table->integer('hotel');
            $table->integer('bread_breakfast');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listing_describes');
    }
};
