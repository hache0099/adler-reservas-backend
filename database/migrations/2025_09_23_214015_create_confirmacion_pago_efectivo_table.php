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
        Schema::create('confirmacion_pago_efectivo', function (Blueprint $table) {
            $table->id();
             // La FK al pago que se está confirmando.
            $table->foreignId('pago_membresia_id')->constrained('pago_membresia')->cascadeOnDelete();
            // La FK al empleado (user) que realiza la confirmación.
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('confirmacion_pago_efectivo');
    }
};
