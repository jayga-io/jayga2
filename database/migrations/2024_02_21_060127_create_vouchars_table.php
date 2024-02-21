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
            $table->double('amount');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('campaign_id');
            $table->boolean('isActive');
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
