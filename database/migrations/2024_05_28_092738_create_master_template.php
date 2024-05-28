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
        Schema::create('master_template', function (Blueprint $table) {
            $table->id();
            $table->string('template_name')->unique();
            $table->string('template_version');
            $table->dateTime('template_b_date');
            $table->dateTime('template_e_date');
            $table->string('classification_id');
            $table->text('template_desc')->nullable();
            $table->text('template_path');
            $table->text('template_filename');
            $table->string('template_filetype');
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
        Schema::dropIfExists('master_template');
    }
};
