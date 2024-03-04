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
        Schema::create('user_reviews', function (Blueprint $table) {
            $table->id();
            $table->text('comentario')->nullable();
            $table->boolean('like')->nullable();
            $table->integer('rating')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('produto_id');
            $table->timestamps();
            

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('produto_id')->references('id')->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_reviews');
    }
};
