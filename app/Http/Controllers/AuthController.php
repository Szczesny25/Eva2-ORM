<?php


namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'correo' => 'required|email|unique:usuarios,correo',
            'clave' => 'required|string|min:6',
        ]);

        $usuario = Usuario::create($validated);

        return response()->json([
            'mensaje' => 'Usuario registrado exitosamente',
            'usuario' => $usuario,
        ], 201);
    }
    
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'correo' => 'required|email',
            'clave' => 'required|string',
        ]);

        $usuario = Usuario::where('correo', $credentials['correo'])->first();

        if (!$usuario || $credentials['clave'] !== $usuario->clave) {
            return response()->json(['mensaje' => 'Credenciales incorrectas'], 401);
        }

        return response()->json([
            'mensaje' => 'Bienvenido',
            'usuario' => $usuario,
        ]);
    }
}
