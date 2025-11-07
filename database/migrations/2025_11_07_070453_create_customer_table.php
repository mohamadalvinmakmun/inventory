<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->string('kode_customer', 20)->primary();
            $table->string('nama_customer', 100);
            $table->text('alamat');
            $table->string('phone', 20);
            $table->string('nama_pt', 100)->nullable();
            $table->string('fax', 20)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer');
    }
};