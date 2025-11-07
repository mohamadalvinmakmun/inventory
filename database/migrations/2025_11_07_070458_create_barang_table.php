<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->string('kode_barang', 20)->primary();
            $table->string('nama_barang', 100);
            $table->integer('stok')->default(0);
            $table->decimal('harga_beli', 15, 2);
            $table->decimal('harga_jual', 15, 2);
            $table->string('rak', 50)->nullable();
            $table->string('kode_kategori', 20);
            $table->string('kode_satuan', 20);
            $table->timestamps();

            $table->foreign('kode_kategori')->references('kode_kategori')->on('kategori');
            $table->foreign('kode_satuan')->references('kode_satuan')->on('satuan');
        });
    }

    public function down()
    {
        Schema::dropIfExists('barang');
    }
};