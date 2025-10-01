<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bahan_baku', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 120);
            $table->string('kategori', 60);
            $table->integer('jumlah')->default(0);
            $table->string('satuan', 20);
            $table->date('tanggal_masuk');
            $table->date('tanggal_kadaluarsa');
            $table->enum('status', ['tersedia', 'segera_kadaluarsa', 'kadaluarsa', 'habis'])
                  ->default('tersedia');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bahan_baku');
    }
};