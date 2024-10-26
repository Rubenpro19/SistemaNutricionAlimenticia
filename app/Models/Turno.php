<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;

    protected $table = 'turno';

    protected $fillable = [
        'fecha_hora',
        'nutricionista_id',
        'paciente_id',
        'estado_turno',
    ];

    public function usuario()
    {
        return $this->hasMany(Usuario::class, 'usuario_id');
    }

    public function estado_turno()
    {
        return $this->belongsTo(EstadoTurno::class,'estado_turno_id');
    }

    public function atencion(){
        return $this->hasMany(Atencion::class,'atencion_id');
    }
}