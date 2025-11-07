<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('delivery_order', function (Blueprint $table) {
            $table->string('no_do', 20)->primary();
            $table->date('tanggal_do');
            $table->string('no_so', 20);
            $table->string('kode_pegawai', 20);
            $table->text('keterangan')->nullable();
            $table->enum('status', ['draft', 'shipped', 'delivered', 'cancelled'])->default('draft');
            $table->timestamps();

            $table->foreign('no_so')->references('no_so')->on('sales_order');
            $table->foreign('kode_pegawai')->references('kode_pegawai')->on('pegawai');
        });
    }

    public function down()
    {
        Schema::dropIfExists('delivery_order');
    }
};