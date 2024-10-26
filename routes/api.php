<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DatoPersonalController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\EstadoTurnoController;
use App\Http\Controllers\TurnoController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//CRUD de Usuario
Route::get('/usuario', [UsuarioController::class, 'index'])->name('usuario.index'); //Ver todos los usuario
Route::get('/usuario/{id}', [UsuarioController::class, 'show'])->name('usuario.show'); //Ver usuario específico
Route::post('/usuario', [UsuarioController::class, 'store'])->name('usuario.store'); //Crear un usuario
Route::put('/usuario/{id}', [UsuarioController::class, 'update'])->name('usuario.update'); //Actualiza un usuario
Route::delete('/usuario/{id}', [UsuarioController::class, 'destroy'])->name('usuario.delete'); //Borra un usuario

//Rutas para autenticación
Route::post('/login', [UsuarioController::class, 'login'])->name('usuario.login');
Route::post('/logout', [UsuarioController::class,'logout'])->name('usuario.logout');

//CRUD de Datos Personales
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/datos-personales', [DatoPersonalController::class, 'index']);
    Route::post('/datos-personales', [DatoPersonalController::class, 'store']);
    Route::get('/datos-personales/{id}', [DatoPersonalController::class, 'show']);
    Route::put('/datos-personales', [DatoPersonalController::class, 'update']);
    Route::delete('/datos-personales', [DatoPersonalController::class, 'destroy']);
});

//CRUD de rol
Route::get('/rol', [RolController::class, 'index'])->name('rol.index');//Listar todos los roles
Route::get('/rol/{id}', [RolController::class, 'show'])->name('rol.show');//Mostrar roles por id
Route::post('/rol', [RolController::class, 'store'])->name('rol.create'); //Crear nuevo rol
Route::put('/rol/{id}', [RolController::class, 'update'])->name('rol.update');//Actualizar un rol
Route::delete('/rol/{id}', [RolController::class, 'destroy'])->name('rol.destroy');//Eliminar un rol

//CRUD de estado turno
Route::get('/estado_turno', [EstadoTurnoController::class, 'index'])->name('estado_turno.index');//Listar todos los estado turno
Route::get('/estado_turno/{id}', [EstadoTurnoController::class, 'show'])->name('estado_turno.show');//Mostrar estado turno por id
Route::post('/estado_turno', [EstadoTurnoController::class, 'store'])->name('estado_turno.create'); //Crear nuevo estado turno
Route::put('/estado_turno/{id}', [EstadoTurnoController::class, 'update'])->name('estado_turno.update');//Actualizar un estado turno
Route::delete('/estado_turno/{id}', [EstadoTurnoController::class, 'destroy'])->name('estado_turno.destroy');//Eliminar un estado turno

//CRUD de turno
Route::get('/turno', [TurnoController::class, 'index'])->name('turno.index');//Listar todos los turnos
Route::get('/turno/{id}', [TurnoController::class, 'show'])->name('turno.show');//Mostrar turnos por id
Route::post('/turno', [TurnoController::class, 'store'])->name('turno.create'); //Crear nuevo turno
Route::delete('/turno/{id}', [TurnoController::class, 'destroy'])->name('turno.destroy');//Eliminar un turno

//ESTO DE AQUÍ NO SIRVE
Route::put('/turno/{id}', [TurnoController::class, 'update'])->name('turno.update');//Actualizar un turno
//ESTE DE AQUÍ NO SIRVE


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
