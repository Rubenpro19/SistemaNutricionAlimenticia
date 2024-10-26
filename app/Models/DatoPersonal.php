<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatoPersonal extends Model
{
    use HasFactory;

    protected $table = 'dato_personal';

    protected $fillable = [
        'ci',
        'telefono',
        'fecha_nacimiento',
        'ciudad',
        'sexo',
        'usuario_id',
    ];
    
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
