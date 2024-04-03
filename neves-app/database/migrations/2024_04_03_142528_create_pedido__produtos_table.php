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
        Schema::create('pedido_produtos', function (Blueprint $table) {
            $table->id();
            $table->integer('quantidade');
            $table->string('cor', 10)->nullable();
            $table->string('texto')->nullable();
            $table->unsignedBigInteger('produto_id');
            $table->unsignedBigInteger('pedido_id');
            $table->timestamps();

            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->foreign('pedido_id')->references('id')->on('pedido_detalhes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_produtos');
    }
};
