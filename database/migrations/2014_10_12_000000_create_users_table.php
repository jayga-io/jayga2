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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('phone');
            $table->bigInteger('user_nid')->nullable();
            $table->string('user_dob')->nullable();
            $table->string('user_address')->nullable();
            $table->boolean('is_lister')->default(false);
            $table->float('user_long')->nullable();
            $table->float('user_lat')->nullable();
            $table->integer('platform_tag')->nullable();
            $table->string('FCM_token')->nullable();
           
            $table->string('access_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
