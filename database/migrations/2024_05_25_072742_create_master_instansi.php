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
        Schema::create('master_instansi', function (Blueprint $table) {
            $table->id();
            $table->string('name_ins')->unique();
            $table->string('address_ins')->nullable();
            $table->integer('zipcode_ins')->nullable();
            $table->text('phone_ins')->nullable();
            $table->text('fax_ins')->nullable();
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
        Schema::dropIfExists('master_instansi');
    }
};
