<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuruTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // nama, mapel, umur, foto
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->string('namaGuru');
            $table->string('mapel');
            $table->integer('umur');
            $table->text('fotoGuru');
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
        Schema::dropIfExists('guru');
    }
}
