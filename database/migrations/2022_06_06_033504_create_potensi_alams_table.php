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
        Schema::create('potensi_alams', function (Blueprint $table) {
            $table->id();
            $table->text('image')->nullable();
            $table->text('des');
            $table->text('des1')->nullable();
            $table->text('batas_utara');
            $table->text('batas_timur');
            $table->text('batas_selatan');
            $table->text('batas_barat');
            $table->string('operator',20);
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
        Schema::dropIfExists('potensi_alams');
    }
};
