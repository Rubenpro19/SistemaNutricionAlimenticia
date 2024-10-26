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
        Schema::create('atencion', function (Blueprint $table) {
            $table->id();
            $table->float('altura');
            $table->float('peso');
            $table->float('cintura');
            $table->float('cadera');
            $table->float('circunferencia_muneca');
            $table->float('circunferencia_cuello');
            $table->enum('actividad_fisica', ['Alta', 'Media', 'Baja']); //Aquí se elige la actividad física entre las opciones dadas
            $table->float('imc');
            $table->float('tmb');
            $table->float('cintura_talla');
            $table->float('cintura_cadera');
            $table->float('porcetaje_grasa');            
            $table->string('complexion_hueso');
            $table->text('observacion'); //Aquí se guarda una observación 
            $table->foreignId('turno_id')->constrained('turno')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atencion');
    }
};
