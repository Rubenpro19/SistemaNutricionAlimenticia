<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoTurno extends Model
{
    use HasFactory;

    protected $table = 'estado_turno';

    protected $fillable = [
        'nombre_estado',
        'descripcion',
    ];

    public function turno(){
        return $this->hasMany(Turno::class, 'turno_id');
    }
}
