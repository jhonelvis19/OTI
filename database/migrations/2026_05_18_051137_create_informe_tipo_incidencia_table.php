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
        Schema::create('informe_tipo_incidencia', function (Blueprint $table) {

            $table->id();

            $table->foreignId('informe_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('tipo_incidencia_id')
                ->constrained('tipos_incidencias')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informe_tipo_incidencia');
    }
};
