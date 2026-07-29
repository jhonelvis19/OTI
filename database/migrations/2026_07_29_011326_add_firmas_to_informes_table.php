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
        Schema::table('informes', function (Blueprint $table) {
            $table->string('firma_persona')->nullable();
            $table->string('firma_tecnico')->nullable();
            $table->timestamp('firma_persona_fecha')->nullable();
            $table->timestamp('firma_tecnico_fecha')->nullable();
            $table->enum('firma_persona_metodo', ['dibujada', 'foto'])->nullable();
            $table->enum('firma_tecnico_metodo', ['dibujada', 'foto', 'perfil'])->nullable();
            $table->boolean('firmas_bloqueadas')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('informes', function (Blueprint $table) {
            $table->dropColumn([
                'firma_persona',
                'firma_tecnico',
                'firma_persona_fecha',
                'firma_tecnico_fecha',
                'firma_persona_metodo',
                'firma_tecnico_metodo',
                'firmas_bloqueadas'
            ]);
        });
    }
};
