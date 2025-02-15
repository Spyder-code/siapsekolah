<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaEkskulsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota_ekskul', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ekstrakurikuler_id');
            $table->foreignId('siswa_id');
            $table->foreignId('sekolah_id')->constrained('sekolah');
            $table->enum('predikat', ['A', 'B', 'C', 'D'])->default('B')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anggota_ekskul');
    }
}
