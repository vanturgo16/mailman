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
        Schema::create('daftar_lantai', function (Blueprint $table) {
            $table->id();
            $table->string('id_gedung')->unique();
            $table->string('kode_lantai')->unique();
            $table->string('nama_lantai');
            $table->integer('kapasitas_lantai');
            $table->text('keterangan_lantai')->nullable();
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
        Schema::dropIfExists('daftar_lantai');
    }
};
