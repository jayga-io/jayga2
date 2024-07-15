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
        Schema::create('user_vouchars', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('vouchar_id')->unsigned();
            $table->foreign('vouchar_id')->references('id')->on('vouchars')->onDelete('cascade');
            $table->string('discount_type');
            $table->bigInteger('discount_value');
            
            $table->bigInteger('max_discount');
            $table->string('validity_start');
            $table->string('validity_end');
            $table->string('created_on');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_vouchars');
    }
};
