<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('akun_bank', function (Blueprint $table) {
            $table->string('kode_akun', 20)->primary();
            $table->string('nama_akun', 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('akun_bank');
    }
};