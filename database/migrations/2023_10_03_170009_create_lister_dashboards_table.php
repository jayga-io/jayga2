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
        Schema::create('lister_dashboards', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('lister_id')->unsigned()->nullable();
            $table->foreign('lister_id')->references('id')->on('users')->onDelete('cascade');
            $table->double('total_earnings')->nullable();
            $table->double('earnings')->nullable();
            $table->double('withdraws')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lister_dashboards');
    }
};
