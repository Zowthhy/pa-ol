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
        Schema::create('herramientas', function (Blueprint $table) {
            $table->id();
            $table -> timestamps();
            $table -> string('estado', 100);
            $table -> string('tipo_herramienta', 100);
            $table -> boolean('disponible')->default(true);
            $table -> string('codigo_barras', 50)->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_herramientas');
    }
};
