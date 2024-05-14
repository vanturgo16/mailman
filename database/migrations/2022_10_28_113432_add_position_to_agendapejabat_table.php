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
        Schema::table('agenda_pejabats', function (Blueprint $table) {
            $table->text('map');
            $table->text('file_surat');
            $table->text('file_acara');
            $table->text('file_sambutan');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agenda_pejabats', function (Blueprint $table) {
            //
        });
    }
};
