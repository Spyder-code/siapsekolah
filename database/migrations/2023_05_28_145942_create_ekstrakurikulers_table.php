<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEkstrakurikulersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ekstrakurikuler', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tapel_id');
            $table->foreignId('guru_id');
            $table->foreignId('sekolah_id')->constrained('sekolah');
            $table->string('name');
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
        Schema::dropIfExists('ekstrakurikuler');
    }
}
