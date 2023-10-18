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
            $table->id('id');
            $table->bigInteger('listing_id')->unsigned();
            $table->foreign('listing_id')->references('listing_id')->on('listings')->onDelete('cascade');
            $table->boolean('smoke_alarm');
            $table->boolean('first_aid_kit');
            $table->boolean('fire_extinguisher');
            $table->boolean('CO_alarm');
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
