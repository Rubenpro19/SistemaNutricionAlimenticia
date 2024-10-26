<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atencion extends Model
{
    use HasFactory;

    protected $table = 'atencion';

    protected $fillable = [
        'altura',
        'peso',
        'cintura',
        'cadera',
        'circunferencia_muneca',
        'circunferencia_cuello',
        'actividad_fisica',
        'imc',
        'tmb',
        'cintura_talla',
        'cintura_cadera',
        'porcentaje_grasa',
        'complexion_hueso',
        'observacion',
        'turno_id',
    ];

    public function turno(){
        return $this->belongsTo(Turno::class,'turno_id');
    }
}
