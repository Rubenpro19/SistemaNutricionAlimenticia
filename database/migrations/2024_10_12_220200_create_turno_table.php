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
        Schema::create('turno', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_hora'); //Se almacena la fecha y la hora en un solo atributo
            $table->foreignId('nutricionista_id')->constrained('usuario')->onDelete('cascade'); //Clave foránea que hace referncia a un usuario con el rol de nutricionista
            $table->foreignId('paciente_id')->nullable()->constrained('usuario')->onDelete('cascade'); //Clave foránea que hace referencia a un usuario con el rol de paciente
            $table->foreignId('estado_turno_id')->constrained('estado_turno')->onDelete('cascade'); //Clave foránea que hace referencia a la tabla de estado_turno
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turno');
    }
};
