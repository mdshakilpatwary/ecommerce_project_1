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
            $table->string('size_id')->nullable();
            $table->string('kg_liter')->nullable();
            $table->string('color_id')->nullable();
            $table->string('p_code')->uniqid();
            $table->string('p_name');
            $table->text('p_description');
            $table->float('p_price');
            $table->integer('discount_percentage')->nullable();            
            $table->integer('p_qty');
            $table->string('p_image');
            $table->string('group_p_image');
            $table->string('p_slug');
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
