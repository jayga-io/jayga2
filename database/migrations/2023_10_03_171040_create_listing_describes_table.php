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
            $table->id('id');
            $table->bigInteger('listing_id')->unsigned();
            $table->foreign('listing_id')->references('listing_id')->on('listings')->onDelete('cascade');
            $table->boolean('apartments');
            $table->boolean('cabin');
            $table->boolean('lounge');
            $table->boolean('farm');
            $table->boolean('campsite');
            $table->boolean('hotel');
            $table->boolean('bread_breakfast');
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
