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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('cat_id');
            $table->integer('subcat_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('unit_id')->nullable();
            $table->integer('size_id')->nullable();
            $table->integer('color_id')->nullable();
            $table->string('p_code')->uniqid();
            $table->string('p_name');
            $table->text('p_description');
            $table->float('p_price');
            $table->string('p_image');
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
