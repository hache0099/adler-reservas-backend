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
        Schema::table('users', function (Blueprint $table) {
            // Asegúrate que las tablas referenciadas existan primero
            if (!Schema::hasTable('personas')) {
                throw new RuntimeException('La tabla personas no existe');
            }
            if (!Schema::hasTable('perfiles')) {
                throw new RuntimeException('La tabla perfiles no existe');
            }

            // Agregar columnas foráneas (si no existen)
            if (!Schema::hasColumn('users', 'persona_id')) {
                $table->foreignId('persona_id')
                    ->constrained('personas')
                    ->onDelete('cascade'); // Opcional: define el comportamiento al eliminar
            }

            if (!Schema::hasColumn('users', 'perfil_id')) {
                $table->foreignId('perfil_id')
                    ->default(3) // Valor por defecto como en tu esquema original
                    ->constrained('perfiles');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
