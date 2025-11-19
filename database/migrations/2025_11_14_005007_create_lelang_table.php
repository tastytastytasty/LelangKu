<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lelang', function (Blueprint $table) {
            $table->increments('id_lelang');
            $table->unsignedInteger('id_barang');
            $table->date('tgl_lelang');
            $table->bigInteger('harga_akhir');
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_petugas');
            $table->enum('status', ['dibuka', 'ditutup'])->default('ditutup');
            $table->timestamps();

            $table->foreign('id_barang')->references('id_barang')->on('barang')->onDelete('restrict');
            $table->foreign('id_user')->references('id_user')->on('masyarakat')->onDelete('restrict');
            $table->foreign('id_petugas')->references('id_petugas')->on('petugas')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lelang');
    }
};
