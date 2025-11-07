<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->string('username', 50)->primary();
            $table->string('password');
            $table->string('nama', 100);
            $table->enum('status', ['tidak aktif', 'aktif'])->default('aktif');
            $table->enum('level', ['admin', 'user', 'pimpinan'])->default('user');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin');
    }
};