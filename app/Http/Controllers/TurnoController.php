<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TurnoController extends Controller
{
    
    public function index()
    {
        //esta funcion simplemete muestra en el calendario los turnos 
        //indiferente del estado del turno
        //en el frondend se mostrata de direntes colores dependiendo del estado 
        
        $turno = Turno::all();
        return response()->json($turno);

    }

    // reservar turno

    public function reservar(Request $request){
        
        //para reservar hay que listar los turnos y mostrar los estados de los turnos
        //si un tuno esta libre se puede reservar
        //sino pues no se va a poder reservar
        //todos los turnos estan libres por defecto
        //cada turno demora 1 hora
        //comienzan los turnos matuntinos de las 8 a las 12
        //luego los bespertinos de 2pm a 6pm
        //los sabados los turnos son de las 9am a 12pm
        //y los domingos no hay turnos

        $usuario = Auth::user();
        if (!$usuario) {
            return response()->json(["message" => "Usuario no encontrado"], 404);
        }
    
        $turno = Turno::find($request->turno_id);
    
        // Verificamos que el turno esté libre antes de reservarlo
        if ($turno && $turno->estado == 'libre') {
            $turno->update([
                'estado' => 'reservado',
                'usuario_id' => $usuario->id, // Asigna el turno al usuario
            ]);
            return response()->json(["message" => "Turno reservado con éxito"], 200);
        } else {
            return response()->json(["message" => "Turno no disponible"], 400);
        }
    }

    public function store(Request $request)
    {
        //slos turnos se crean todos los dias 
        //es mas es la agenda y uno puede reservar el tuno del dia actual a dias posteriosres 
        //con exepcion de los domingos porque no hay turnos
        $diasSemana = ['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];
        $horarios = [
        'matutino' => ['08:00', '09:00', '10:00', '11:00'],
        'vespertino' => ['14:00', '15:00', '16:00', '17:00']
    ];

    foreach ($diasSemana as $dia) {
        foreach ($horarios as $turnoDia) {
            foreach ($turnoDia as $hora) {
                Turno::create([
                    'dia' => $dia,
                    'hora' => $hora,
                    'estado' => 'libre'
                ]);
            }
        }
    }

    return response()->json(["message" => "Turnos creados con éxito"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Turno $turno)
    {
    
        //seria listar el turno que el usuario tiene reservado, con hora, nutricionista, etc...
        if ($turno->estado == 'reservado') {
            return response()->json($turno);
        } else {
            return response()->json(["message" => "El turno no está reservado"], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Turno $turno)
    {
       //funcionariade la forma en la cual si tengo un turno reservado para el lunes 9pm 
       //y ya no puedo ir puedo cambiarlo a un turno posterior que este libre 
       //y asi poder escojer otro dia a otra hora
       if ($turno->estado == 'reservado' && $turno->usuario_id == Auth::id()) {
        $nuevoTurno = Turno::find($request->nuevo_turno_id);

        if ($nuevoTurno && $nuevoTurno->estado == 'libre') {
            $turno->update(['estado' => 'libre']);
            $nuevoTurno->update(['estado' => 'reservado', 'usuario_id' => Auth::id()]);

            return response()->json(["message" => "Turno actualizado con éxito"], 200);
        } else {
            return response()->json(["message" => "El nuevo turno no está disponible"], 400);
        }
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Turno $turno)
    {
        //esta funcion seria si yo tengo un turno reservado
        //lo puedo cancelar
        //y en tal caso pasaria el turno a libre si aun tiene tiempo y sino pues a caducado
        //si se o canecla a ultimo momento
        $usuario = Auth::user();
    if ($turno->estado == 'reservado' && $turno->usuario_id == $usuario->id) {
        $turno->update(['estado' => 'libre', 'usuario_id' => null]);
        return response()->json(["message" => "Turno cancelado"], 200);
    } else {
        return response()->json(["message" => "El turno no puede ser cancelado"], 400);
    }
    }
}
