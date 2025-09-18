<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //funcion de crear
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id(); 
            $table->string('nombre');
            $table->string('email')->unique();
            $table->string('telefono')->nullable();
            $table->string('empresa')->nullable();

            $table->timestamps(); 
        });
    }

    //funcion de eliminar
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
