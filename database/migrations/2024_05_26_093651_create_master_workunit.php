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
        Schema::create('master_workunit', function (Blueprint $table) {
            $table->id();
            $table->string('work_code');
            $table->string('work_name');
            $table->string('work_head_name');
            $table->string('work_desc');
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
        Schema::dropIfExists('master_workunit');
    }
};
