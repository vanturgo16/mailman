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
        Schema::create('daftar_gedung', function (Blueprint $table) {
            $table->id();
            $table->string('kode_gedung')->unique();
            $table->string('nama_gedung');
            $table->integer('kapasitas_gedung');
            $table->text('keterangan_gedung')->nullable();
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
        Schema::dropIfExists('daftar_gedung');
    }
};
