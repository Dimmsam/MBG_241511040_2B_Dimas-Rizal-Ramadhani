<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('permintaan_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permintaan_id')
                  ->constrained('permintaan')
                  ->onDelete('cascade');
            $table->foreignId('bahan_id')
                  ->constrained('bahan_baku')
                  ->onDelete('cascade');
            $table->integer('jumlah_diminta');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('permintaan_detail');
    }
};