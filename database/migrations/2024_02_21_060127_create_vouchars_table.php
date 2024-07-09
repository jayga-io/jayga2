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
        Schema::create('vouchars', function (Blueprint $table) {
            $table->id();
            $table->string('vouchar_code');
            $table->string('discount_type');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('discount_value');
            $table->integer('min_days');
            $table->bigInteger('min_amount');
            $table->bigInteger('max_discount');
            $table->string('validity_start');
            $table->string('validity_end');
            $table->integer('usage_limit');
            $table->bigInteger('usage_count');
            $table->string('created_on');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchars');
    }
};
