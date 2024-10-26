<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $table = 'usuario';

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'rol_id'
    ];

    protected $hidden = [
        'password',
    ];

    // Mutator para encriptar la contraseña automáticamente
    public function setPasswordAttribute($value){
        $this->attributes['password'] = Hash::make($value); // Usa Hash::make para encriptar
    }

    // Relacion con Rol
    public function rol(){
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    public function turnos(){
        return $this->hasMany(Turno::class,'turno_id');
    }

    public function dato_personal(){
        return $this->hasOne(DatoPersonal::class,'dato_personal_id');
    }
}
