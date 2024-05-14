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
        Schema::create('agenda_pejabats', function (Blueprint $table) {
            $table->id();
            $table->char('id_pejabat',10);
            $table->string('pendamping',100);
            $table->string('pj',100);
            $table->string('opd',100);
            $table->text('nm_kegiatan');
            $table->char('tempat',50);
            $table->date('tgl');
            $table->time('jam_mulai');
            $table->time('jam_selsai');
            $table->char('sk',20);
            $table->char('status_t',20);
            $table->char('creator',50);
            $table->char('eksekutor',50);
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
        Schema::dropIfExists('agenda_pejabats');
    }
};
