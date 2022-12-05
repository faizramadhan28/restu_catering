<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordersubs', function (Blueprint $table) {
            $table->string('id')->unique()->primary('id');
            $table->foreignId('user_id')->constrained('users');
            $table->string('nama_penerima');
            $table->string('telp_penerima');
            $table->text('alamat_penerima');
            $table->dateTime('waktu_kirim');
            $table->dateTime('waktu_berakhir');
            $table->longText('pesanan');
            $table->string('type_pembayaran');
            $table->string('type_pengiriman');
            $table->string('durasi');
            $table->dateTime('kadaluarsa');
            $table->string('bukti_pembayaran')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('ordersubs');
    }
}
