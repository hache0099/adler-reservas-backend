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
        Schema::table('canchas', function (Blueprint $table) {
            //
			$table->string('ubicacion_descripcion', 255)->nullable()->after('estado_cancha_id');
            
            // Usamos decimal para precisión en coordenadas. 10 dígitos totales, 7 después del punto.
            $table->decimal('latitud', 10, 7)->nullable()->after('ubicacion_descripcion');
            $table->decimal('longitud', 10, 7)->nullable()->after('latitud');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('canchas', function (Blueprint $table) {
            //
			$table->dropColumn(['ubicacion_descripcion', 'latitud', 'longitud']);
        });
    }
};
