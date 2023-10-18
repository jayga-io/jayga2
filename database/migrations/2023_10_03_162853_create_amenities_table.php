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
        Schema::create('amenities', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('listing_id')->unsigned();
            $table->foreign('listing_id')->references('listing_id')->on('listings')->onDelete('cascade');
            $table->boolean('wifi');
            $table->boolean('tv');
            $table->boolean('kitchen');
            $table->boolean('washer');
            $table->boolean('free_parking');
            $table->boolean('paid_parking');
            $table->boolean('dedicated_workspace');
            $table->boolean('pool');
            $table->boolean('hot_tub');
            $table->boolean('patio');
            $table->boolean('bbq_grill');
            $table->boolean('outdoor_dining_area');
            $table->boolean('fire_pit');
            $table->boolean('gym');
            $table->boolean('beach_access');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amenities');
    }
};
