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
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table -> unsignedBigInteger('id_herramienta');
            $table -> unsignedBigInteger('id_encargado');
            $table -> unsignedBigInteger('id_usuario');
            $table->foreign(['id_herramienta'], 'prestamos_ibfk_1')->references(['id'])->on('herramientas')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['id_encargado'], 'prestamos_ibfk_2')->references(columns: ['id'])->on('users')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['id_usuario'], 'prestamos_ibfk_3')->references(['id'])->on('usuarios')->onUpdate('restrict')->onDelete('restrict');
            $table -> dateTime('devolucion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_prestamos');
    }
};
