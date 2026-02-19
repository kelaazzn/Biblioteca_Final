<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Creamos primero la tabla de categorías
        Schema::create('categorias', function(Blueprint $table){
            $table->id();
            $table->string('nombre', 255);
            $table->timestamps();
        });
        
        // 2. Si quieres crear libros aquí mismo, asegúrate de que no exista otra migración de libros
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->string('isbn', 100);
            $table->string('autor', 255);
            $table->string('editorial', 255);
            $table->smallInteger('estatus')->default(0);
            $table->unsignedBigInteger('categoria_id');
            $table->timestamps();

            // La referencia debe ser a 'categorias', que es el nombre que pusimos arriba
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        // El orden importa al borrar por las llaves foráneas
        Schema::dropIfExists('libros');
        Schema::dropIfExists('categorias');
    }
};