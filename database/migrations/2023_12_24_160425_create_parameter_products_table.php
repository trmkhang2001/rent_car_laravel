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
        Schema::create('parameter_products', function (Blueprint $table) {
            $table->id();
            $table->integer('id_product')->unique();
            $table->string('main')->nullable();
            $table->string('cpu')->nullable();
            $table->string('ram')->nullable();
            $table->string('vga')->nullable();
            $table->string('hhd')->nullable();
            $table->string('ssd')->nullable();
            $table->string('psu')->nullable();
            $table->string('case')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parameter_products');
    }
};
