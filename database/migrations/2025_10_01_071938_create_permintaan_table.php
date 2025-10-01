<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('permintaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemohon_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->date('tgl_masak');
            $table->string('menu_makan', 255);
            $table->integer('jumlah_porsi');
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak'])
                  ->default('menunggu');
            $table->text('alasan_tolak')->nullable(); // Bonus untuk rejection reason
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('permintaan');
    }
};