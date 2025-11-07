<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('gudang', function (Blueprint $table) {
            $table->string('id_gudang', 20)->primary();
            $table->string('nama_gudang', 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gudang');
    }
};