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
        Schema::create('pedido_detalhes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('apelido');
            $table->string('email');
            $table->string('morada');
            $table->string('cidade', 60);
            $table->string('codigo_postal', 12);
            $table->string('pais', 60);
            $table->string('telemovel', 15)->nullable();
            $table->text('descricao')->nullable();
            $table->integer('quant_total');
            $table->decimal('total_pag', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_detalhes');
    }
};
