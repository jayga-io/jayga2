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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('business_location_id')->unsigned();
            $table->foreign('business_location_id')->references('business_id')->on('business_locations')->onDelete('cascade');
            $table->string('item_name');
            $table->string('quantity_type');
            $table->bigInteger('quantity_value');
            $table->string('item_type');
            $table->string('item_size');
            $table->string('additional_details');
            $table->json('additional_services');
            $table->string('created_on');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
