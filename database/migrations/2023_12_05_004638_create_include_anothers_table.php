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
        Schema::create('include_anothers', function (Blueprint $table) {
            $table->id();
            $table->integer('shipping_charge_insite')->nullable();
            $table->integer('shipping_charge_outsite')->nullable();
            $table->decimal('tax_vat')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('include_anothers');
    }
};
