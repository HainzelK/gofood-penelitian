<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plottings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // ITPT, IRPT, dll
            $table->string('location');       // Toraja, Makassar
            $table->integer('max_capacity')->default(30);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plottings');
    }
};