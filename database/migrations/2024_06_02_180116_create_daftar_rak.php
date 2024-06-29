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
        Schema::create('daftar_rak', function (Blueprint $table) {
            $table->id();
            $table->string('id_ruang')->unique();
            $table->string('kode_rak')->unique();
            $table->string('nama_rak');
            $table->integer('kapasitas_rak');
            $table->text('keterangan_rak')->nullable();
            $table->tinyInteger('is_active')->default(1);
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
        Schema::dropIfExists('daftar_rak');
    }
};
