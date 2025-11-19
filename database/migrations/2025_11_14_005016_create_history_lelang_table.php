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
        Schema::create('history_lelang', function (Blueprint $table) {
            $table->increments('id_history');
            $table->unsignedInteger('id_lelang');
            $table->unsignedInteger('id_barang');
            $table->unsignedInteger('id_user');
            $table->bigInteger('penawaran_harga');
            $table->timestamps();

            $table->foreign('id_lelang')->references('id_lelang')->on('lelang')->onDelete('restrict');
            $table->foreign('id_barang')->references('id_barang')->on('barang')->onDelete('restrict');
            $table->foreign('id_user')->references('id_user')->on('masyarakat')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_lelang');
    }
};
