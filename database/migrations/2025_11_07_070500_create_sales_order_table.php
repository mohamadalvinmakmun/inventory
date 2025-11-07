<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sales_order', function (Blueprint $table) {
            $table->string('no_so', 20)->primary();
            $table->date('tanggal_so');
            $table->string('kode_customer', 20);
            $table->string('kode_pegawai', 20);
            $table->text('keterangan')->nullable();
            $table->enum('status', ['draft', 'confirmed', 'completed', 'cancelled'])->default('draft');
            $table->decimal('total', 15, 2);
            $table->timestamps();

            $table->foreign('kode_customer')->references('kode_customer')->on('customer');
            $table->foreign('kode_pegawai')->references('kode_pegawai')->on('pegawai');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales_order');
    }
};