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
        Schema::create('pejabat_daerahs', function (Blueprint $table) {
            $table->id();
            $table->text('image')->nullable();
            $table->string('nm_pejabat',50);
            $table->char('id_jabatan',11);
            $table->string('email',30)->nullable();
            $table->string('operator',50)->nullable();           
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
        Schema::dropIfExists('pejabat_daerahs');
    }
};
