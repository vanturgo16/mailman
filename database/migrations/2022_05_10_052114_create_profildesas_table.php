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
        Schema::create('profildesas', function (Blueprint $table) {
            $table->id();
            $table->string('nm_desa', 45)->nullable();
            $table->text('alamat')->nullable();
            $table->string('tlpn', 15);
            $table->string('email', 100)->nullable();
            $table->text('fb');
            $table->text('tw');
            $table->text('ig');
            $table->text('youtube');
            $table->string('created',50)->nullable();

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
        Schema::dropIfExists('profildesas');
    }
};
