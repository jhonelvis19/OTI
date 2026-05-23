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
        Schema::create('informes', function (Blueprint $table) {

            $table->id();

            // DATOS AUTOMÁTICOS
            $table->string('codigo_informe')->unique();

            $table->date('fecha');

            $table->time('hora_inicio');

            $table->time('hora_salida')->nullable();

            // USUARIO QUE REGISTRA
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            // DATOS DEL USUARIO ATENDIDO
            $table->string('nombre_atendido');

            $table->string('dni_atendido', 8);

            // SEDE Y OFICINA
            $table->foreignId('sede_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('oficina_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');

            $table->string('otra_oficina')->nullable();

            // PERSONA ATENDIDA
            $table->enum('persona_atendida', [
                'titular',
                'usuario',
                'otros'
            ]);

            // FACILIDADES
            $table->boolean('brindaron_facilidad')
                ->default(false);

            // DATOS DEL EQUIPO
            $table->string('codigo_patrimonial');

            $table->foreignId('tipo_equipo_id')
                ->constrained('tipos_equipos')
                ->onDelete('cascade');

            $table->string('marca');

            $table->string('modelo');

            $table->string('serie');

            // CANTIDAD DE EQUIPOS
            $table->integer('numero_equipos')
                ->default(1);

            // DESCRIPCIÓN DEL PROBLEMA
            $table->text('descripcion_problema');

            // RESOLUCIÓN TÉCNICA
            $table->text('resolucion_tecnica');

            // RESULTADO
            $table->boolean('solucionado')
                ->default(true);

            $table->text('motivo_no_solucion')
                ->nullable();

            // OBSERVACIONES
            $table->text('observaciones')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informes');
    }
};
