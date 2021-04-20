<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaravelFileManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laravel_file_manager', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('media_type')->comment('1.image, 2.video, 3.file');
            $table->string('file_path');
            $table->tinyInteger('is_active')->default(1);
            $table->text('attrs')->nullable();
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
        Schema::dropIfExists('laravel_file_manager');
    }
}
