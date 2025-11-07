<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->string('no_invoice', 20)->primary();
            $table->date('tanggal_invoice');
            $table->string('no_so', 20);
            $table->string('kode_customer', 20);
            $table->decimal('subtotal', 15, 2);
            $table->decimal('pajak', 15, 2)->default(0);
            $table->decimal('diskon', 15, 2)->default(0);
            $table->decimal('total', 15, 2);
            $table->enum('status_pembayaran', ['pending', 'paid', 'partial', 'cancelled'])->default('pending');
            $table->date('tanggal_jatuh_tempo')->nullable();
            $table->timestamps();

            $table->foreign('no_so')->references('no_so')->on('sales_order');
            $table->foreign('kode_customer')->references('kode_customer')->on('customer');
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoice');
    }
};