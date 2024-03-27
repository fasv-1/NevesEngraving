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
        Schema::create('envio_portugal', function (Blueprint $table) {
            $table->id();
            $table->integer('peso');
            $table->decimal('valor', 8, 2);                        
            $table->timestamps();
        });

        Schema::create('envio_europa', function (Blueprint $table) {
            $table->id();
            $table->integer('peso');
            $table->decimal('valor', 8, 2);                        
            $table->timestamps();
        });

        Schema::create('envio_eua', function (Blueprint $table) {
            $table->id();
            $table->integer('peso');
            $table->decimal('valor', 8, 2);                        
            $table->timestamps();
        });

        Schema::create('envio_outros', function (Blueprint $table) {
            $table->id();
            $table->integer('peso');
            $table->decimal('valor', 8, 2);                        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('envio_outros');
        Schema::dropIfExists('envio_eua');
        Schema::dropIfExists('envio_europa');
        Schema::dropIfExists('envio_portugal');
    }
};
