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
        Schema::create('daftar_baris', function (Blueprint $table) {
            $table->id();
            $table->string('id_rak')->unique();
            $table->string('kode_baris')->unique();
            $table->string('nama_baris');
            $table->integer('kapasitas_baris');
            $table->text('keterangan_baris')->nullable();
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
        Schema::dropIfExists('daftar_baris');
    }
};
