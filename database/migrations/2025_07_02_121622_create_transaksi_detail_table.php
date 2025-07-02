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
        Schema::create('transaksi_detail', function (Blueprint $table) {
            $table->id()->comment('primary key');
            $table->unsignedBigInteger('transaksi_id')->index()->nullable();
            $table->unsignedBigInteger('barang_id')->index()->nullable();
            $table->integer('qty')->nullable();
            $table->double('harga_satuan', 12,2)->nullable();
            $table->double('subtotal', 12,2)->nullable();
            $table->timestamps();

            $table->foreign('barang_id')->references('id')->on('barang')->onDelete('cascade');
            $table->foreign('transaksi_id')->references('id')->on('transaksi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_detail');
    }
};
