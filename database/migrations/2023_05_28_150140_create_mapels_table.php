<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapel', function (Blueprint $table) {
          $table->id();
          $table->foreignId('tapel_id')->unsigned();
          $table->foreignId('sekolah_id')->constrained('sekolah');
          $table->string('name');
          $table->string('singkatan');
          $table->enum('kelompok', ['A', 'B']);
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
        Schema::dropIfExists('mapel');
    }
}
