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
        Schema::create('menu', function (Blueprint $table) {
            $table->smallIncrements('idmenu');
            $table->string('NamaMenu', 50);
            $table->integer('Harga');
            $table->unsignedSmallInteger('IdResto');

            $table->foreign('IdResto')->references('idrestoran')->on('restoran')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
