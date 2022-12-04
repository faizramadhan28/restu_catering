<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanggananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('langganan', function (Blueprint $table) {
            $table->id();
            $table->string('menu', 128);
            $table->integer('harga');
            $table->text('desc');
            $table->string('durasi', 128);
            $table->string('image', 256);
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
        Schema::dropIfExists('langganan');
    }
}
