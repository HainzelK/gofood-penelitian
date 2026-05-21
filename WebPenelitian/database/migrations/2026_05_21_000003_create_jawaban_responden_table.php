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
        Schema::create('jawaban_responden', function (Blueprint $table) {
            $table->increments('NoJawab');
            $table->date('Tanggal');
            $table->enum('IS', ['Setuju', 'Tidak Setuju']);
            $table->string('Nama', 100);
            $table->enum('Gender', ['Perempuan', 'Laki-laki']);
            $table->tinyInteger('Usia');
            $table->enum('PendidikanTerakhir', ['SMA/Sederajat', 'Diploma(D3)', 'Sarjana(S1)', 'Magister(S2)', 'Doktor(S3)']);
            $table->enum('DaerahDomisili', ['Makassar', 'Toraja']);
            $table->string('Kecamatan', 50);
            $table->string('Pekerjaan', 50);
            $table->string('NoHP', 15);
            $table->string('Plotting', 4);
            $table->integer('Saldo');
            $table->smallInteger('MenuMakanan');
            $table->smallInteger('MenuMinuman');
            $table->integer('Subsidi/Insentif');
            $table->integer('Pajak');
            $table->integer('Total');
            $table->integer('TopUp');
            $table->time('TIME_CASE_PRES');
            $table->time('TIME_ALL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_responden');
    }
};
