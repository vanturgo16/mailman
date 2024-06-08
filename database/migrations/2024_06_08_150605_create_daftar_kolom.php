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
        Schema::create('daftar_kolom', function (Blueprint $table) {
            $table->id();
            $table->string('id_baris')->unique();
            $table->string('kode_kolom')->unique();
            $table->string('nama_kolom');
            $table->integer('kapasitas_kolom');
            $table->text('keterangan_kolom')->nullable();
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
        Schema::dropIfExists('daftar_kolom');
    }
};
