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
        Schema::create('safety_measures', function (Blueprint $table) {
            $table->id('listing_id');
            $table->foreign('listing_id')->references('listing_id')->on('listings')->onDelete('cascade');
            $table->bigInteger('smoke_alarm');
            $table->bigInteger('first_aid_kit');
            $table->bigInteger('fire_extinguisher');
            $table->bigInteger('CO_alarm');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('safety_measures');
    }
};
