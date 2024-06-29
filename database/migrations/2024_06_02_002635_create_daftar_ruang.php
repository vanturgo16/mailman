<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_ruang', function (Blueprint $table) {
            $table->id();
            $table->string('id_lantai')->unique();
            $table->string('kode_ruang')->unique();
            $table->string('nama_ruang');
            $table->integer('kapasitas_ruang');
            $table->text('keterangan_ruang')->nullable();
            $table->string('created_by');
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
        Schema::dropIfExists('daftar_ruang');
    }
};
