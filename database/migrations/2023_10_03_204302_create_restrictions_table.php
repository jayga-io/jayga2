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
        Schema::create('restrictions', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('listing_id')->unsigned();
            $table->foreign('listing_id')->references('listing_id')->on('listings')->onDelete('cascade');
            $table->boolean('indoor_smoke');
            $table->boolean('host_parties');
            $table->boolean('pets');
            $table->boolean('un_vaccinated');
            $table->boolean('late_night_entry');
            $table->boolean('unknown_guest');
            $table->string('anything_specific');
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restrictions');
    }
};
