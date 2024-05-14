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
        Schema::create('pesan_wargas', function (Blueprint $table) {
            $table->id();
            $table->string('nama',50)->nullable();
            $table->string('email',50)->nullable();
            $table->string('subjek',100)->nullable();
            $table->text('pesan')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesan_wargas');
    }
};
