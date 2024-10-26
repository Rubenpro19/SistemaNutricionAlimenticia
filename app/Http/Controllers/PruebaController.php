<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PruebaController extends Controller
{
    //MUESTRA TODOS LOS USUARIOS ALMACENDADOS
    public function index(){
        //La función "all()" obtiene todos los datos del modelo almacendos en la base de datos 
        $usuario = Usuario::all();
        return response()->json($usuario); // Finalmente son retornados en formato json
    }

    //MUESTRA UN USUARIO EN ESPECÍFICO MEDIANTE SU ID
    public function show($id)
    {
        //La función "find()" obtiene el dato del modelo buscándolo mediante su id
        $usuario = Usuario::find($id);

        //Si no existe el usuario se retorna un mensaje de que no ha sido encontrado
        if (!$usuario) {
            return response()->json([
                'message' => 'Usuario no encontrado',
            ]);
        }

        //En caso de si existir se retornan los datos de ese usuario
        return response()->json($usuario);
    }

    //CREA UN USUARIO
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'email' => 'required|email|unique:usuario',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error al crear usuario',
                'errors' => $validator->errors(),
            ], 400);
        }

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => $request->password, //La contraseña se encripta automaticamente en el Modelo
            'rol_id' => 3,
        ]);

        if (!$usuario) {
            return response()->json([
                'message' => 'No se pudo crear el usuario, error en el servidor',
            ], 500);
        }

        return response()->json([
            'usuario' => $usuario,
            'message' => 'Usuario creado exitosamente',
            'status' => 201,
        ], 201);
    }


    //ACTUALIZA UN USUARIO
    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id); //Busca el usuario

        //Verifica si el usuario existe
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado']);
        }

        $validator = Validator::make(
            $request->all(),
            [
                'rol_id' => 'sometimes|exists:rol,id',
                'nombre' => 'sometimes|string|max:255',
                'email' => 'sometimes|email|unique:usuario,email,' . $usuario->id,
                'password' => 'sometimes|min:6'
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->error(), 400);
        }

        $usuario->update([
            'rol_id' => $request->rol_id ?? $usuario->rol_id,
            'nombre' => $request->nombre ?? $usuario->nombre,
            'email' => $request->email ?? $usuario->email,
            'password' => $request->password ?? $usuario->password,
        ]);

        return response()->json($usuario, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $usuario = Usuario::find($id);

        if(!$usuario){
            return response()->json(['message' => 'Usuario no encontrado']);
        }

        //Borrar el usuario (soft delete)
        $usuario->delete();
        return response()->json(['messsage' => 'Usuario eliminado correctamente']);
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)) {
            $usuario = Auth::user();
            $token = $usuario->createToken('API TOKEN')->plainTextToken;
            return response()->json([
                'message' => 'Inicio de sesión exitoso',
                'usuario' => $usuario,
                'token' => $token,
            ], 200);
        }

        return response()->json(['message' => 'Credenciales incorrectas'], 401);
    }

    // Logout del usuario
    public function logout(){
        $usuario = Auth::user();
        $usuario->tokens()->delete(); // Eliminar todos los tokens del usuario autenticado
        return response()->json(['message' => 'Cierre de sesión exitoso'], 200);
    }
}
