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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique();
            $table->string('meta_nome')->nullable();
            $table->integer('quantidade');
            $table->text('descricao');
            $table->decimal('valor', 8, 2);
            $table->boolean('costumizavel');
            $table->timestamps();
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('materia_prima_id');
            $table->unsignedBigInteger('desconto_id');

            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->foreign('materia_prima_id')->references('id')->on('materia_prima');
            $table->foreign('desconto_id')->references('id')->on('descontos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
