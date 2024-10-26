<?php

namespace App\Http\Controllers;

use App\Models\DatoPersonal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DatoPersonalController extends Controller
{
    // Listar datos personales del usuario autenticado
    public function index()
    {
        $usuario = Auth::user(); // Obtener el usuario autenticado
        if ($usuario) {
            $datoPersonal = $usuario->datopersonal; // Relación con DatoPersonal
            return response()->json($datoPersonal);
        }
        return response()->json(['message' => 'Usuario no encontrado'], 404);
    }

    // Mostrar un dato personal específico
    public function show($id)
    {
        $datoPersonal = DatoPersonal::find($id);
        if (!$datoPersonal) {
            return response()->json(['message' => 'Dato personal no encontrado'], 404);
        }
        return response()->json($datoPersonal);
    }

    // Agregar o crear datos personales para el usuario autenticado
    public function store(Request $request)
{
    // Validar los datos entrantes
    $request->validate([
        'ci' => 'required|string|max:20', // Ajusta las reglas de validación según tus necesidades
        'telefono' => 'required|string|max:15',
        'fecha_nacimiento' => 'required|date',
        'ciudad' => 'required|string|max:100',
        'sexo' => 'required|string|in:hombre,mujer', // Asegúrate de definir los valores aceptables
    ]);

    $usuario = Auth::user(); // Obtener el usuario autenticado
    if (!$usuario) {
        return response()->json(['message' => 'Usuario no autenticado'], 401);
    }

    // Crear nuevo DatoPersonal
    $datoPersonal = new DatoPersonal([
        'ci' => $request->ci,
        'telefono' => $request->telefono,
        'fecha_nacimiento' => $request->fecha_nacimiento,
        'ciudad' => $request->ciudad,
        'sexo' => $request->sexo,
    ]);

    // Guardar el dato personal relacionado con el usuario
    $usuario->datopersonal()->save($datoPersonal);

    return response()->json(['message' => 'Datos personales guardados con éxito', 'datoPersonal' => $datoPersonal], 201);
}


    // Actualizar datos personales del usuario autenticado
    public function update(Request $request)
    {
        $usuario = Auth::user();
        if (!$usuario || !$usuario->datopersonal) {
            return response()->json(['message' => 'Datos personales no encontrados'], 404);
        }

        $usuario->datopersonal->update($request->all()); // Actualizar los datos personales relacionados
        return response()->json(['message' => 'Datos personales actualizados con éxito']);
    }

    // Eliminar los datos personales del usuario autenticado
    public function destroy()
    {
        $usuario = Auth::user();
        if (!$usuario || !$usuario->datopersonal) {
            return response()->json(['message' => 'Datos personales no encontrados'], 404);
        }

        $usuario->datopersonal->delete(); // Eliminar los datos personales
        return response()->json(['message' => 'Datos personales eliminados con éxito']);
    }
}
