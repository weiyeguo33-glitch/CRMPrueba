<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //funcion de crear
    public function up(): void
    {
        Schema::create('oportunidades', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->decimal('monto_estimado', 12, 2);
            $table->enum('estado', ['Nueva', 'En proceso', 'Cerrada']);
            $table->timestamps();

            //Mi relacion entre las tablitas
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes');
        });
    }

    //funcion de eliminar
    public function down(): void
    {
        Schema::dropIfExists('oportunidades');
    }
};
