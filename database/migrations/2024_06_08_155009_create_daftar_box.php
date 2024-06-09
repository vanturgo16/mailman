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
        Schema::create('daftar_box', function (Blueprint $table) {
            $table->id();
            $table->string('id_kolom');
            $table->string('kode_box')->unique();
            $table->string('nama_box');
            $table->integer('kapasitas_box');
            $table->text('keterangan_box')->nullable();
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
        Schema::dropIfExists('daftar_box');
    }
};
