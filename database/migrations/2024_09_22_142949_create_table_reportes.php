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
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->longText('descripcion');
            $table -> unsignedBigInteger("id_prestamo");
            $table->foreign(['id_prestamo'], 'reportes_ibfk_1')->references(['id'])->on('prestamos')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_reportes');
    }
};
