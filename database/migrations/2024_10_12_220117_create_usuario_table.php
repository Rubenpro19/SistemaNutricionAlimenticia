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
        Schema::create('usuario', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); //Nombre del usuario
            $table->string('email')->unique(); //El correo electrónico debe ser único
            $table->string('password'); //La contraseña está siendo hasheada en el modelo Usuario
            $table->foreignId('rol_id')->constrained('rol')->onDelete('cascade'); //Clave foránea que hace refencia a la tabla rol
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
