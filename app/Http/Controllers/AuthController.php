<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Services\JwtService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Muestra el formulario de registro.
     */
    public function mostrarRegistro()
    {
        return view('auth.registro');
    }

    /**
     * Registra un nuevo usuario, cifrando la clave antes de guardarla.
     */
    public function registrar(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:usuarios,correo',
            'clave' => 'required|string|min:6',
        ]);

        $usuario = Usuario::create([
            'nombre' => $datos['nombre'],
            'correo' => $datos['correo'],
            // Cifrado de la clave usando el hash de Laravel (bcrypt)
            'clave' => Hash::make($datos['clave']),
        ]);

        // Se retorna la vista de registro mostrando el usuario recién creado
        return view('auth.registro', [
            'usuario' => $usuario,
        ]);
    }

    /**
     * Muestra el formulario de inicio de sesión.
     */
    public function mostrarLogin()
    {
        return view('auth.login');
    }

    /**
     * Valida las credenciales y, si son correctas, genera un JWT.
     */
    public function login(Request $request)
    {
        $datos = $request->validate([
            'correo' => 'required|email',
            'clave' => 'required|string',
        ]);

        $usuario = Usuario::where('correo', $datos['correo'])->first();

        // Se verifica que el usuario exista y que la clave coincida con el hash guardado
        if (! $usuario || ! Hash::check($datos['clave'], $usuario->clave)) {
            return view('auth.login', [
                'error' => 'Correo o clave incorrectos.',
            ]);
        }

        $token = JwtService::generar([
            'id' => $usuario->id,
            'correo' => $usuario->correo,
        ]);

        // Se guarda el token en la sesión para poder navegar por las
        // vistas protegidas (ej. /proyectos) sin tener que copiarlo a mano.
        $request->session()->put('jwt', $token);

        return view('auth.login', [
            'usuario' => $usuario,
            'token' => $token,
        ]);
    }

    /**
     * Cierra la sesión eliminando el JWT guardado.
     */
    public function logout(Request $request)
    {
        $request->session()->forget('jwt');

        return redirect()->route('login');
    }
}
