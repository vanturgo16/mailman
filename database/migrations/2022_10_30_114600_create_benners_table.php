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
        Schema::create('benners', function (Blueprint $table) {
            $table->id();
            $table->text('image')->nullable();
            $table->string('title',150)->nullable();
            $table->text('des')->nullable();
            $table->text('catatan')->nullable();
            $table->string('status',2)->nullable();
            $table->string('creator',50)->nullable();
            $table->string('editor',50)->nullable();
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
        Schema::dropIfExists('benners');
    }
};
