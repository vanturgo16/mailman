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
        Schema::create('master_pattern', function (Blueprint $table) {
            $table->id();
            $table->string('let_id')->unique();
            $table->string('pat_simple')->nullable();
            $table->string('pat_mix')->nullable();
            $table->string('pat_type')->nullable();
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
        Schema::dropIfExists('master_pattern');
    }
};
