<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categorias', function(Blueprint $table){
            $table->id();
            $table->string('nombre', 255);
            $table->timestamps();
        });
        
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->string('isbn', 100);
            $table->string('autor', 255);
            $table->string('editorial', 255);
            $table->smallInteger('estatus')->default(0);
            $table->unsignedBigInteger('categoria_id');
            $table->timestamps();

            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
        });
    }
 
    public function down(): void
    {
        Schema::dropIfExists('libros');
        Schema::dropIfExists('categorias');
    }
};