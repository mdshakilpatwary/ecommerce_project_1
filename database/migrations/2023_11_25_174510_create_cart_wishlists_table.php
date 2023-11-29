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
        Schema::create('cart_wishlists', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('p_id');
            $table->string('p_name');
            $table->string('p_image');
            $table->float('p_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_wishlists');
    }
};
