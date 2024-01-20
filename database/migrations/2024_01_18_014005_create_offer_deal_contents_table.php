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
        Schema::create('offer_deal_contents', function (Blueprint $table) {
            $table->id();
            $table->string('offer_heading');
            $table->string('offer_content');
            $table->date('offer_duration_start');
            $table->date('offer_duration_end');
            $table->string('image1');
            $table->string('image2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_deal_contents');
    }
};
