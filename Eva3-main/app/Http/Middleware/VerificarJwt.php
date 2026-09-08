<?php

namespace App\Http\Middleware;

use App\Services\JwtService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarJwt
{
    /**
     * Verifica que la petición traiga un JWT válido en el header Authorization.
     * Formato esperado: Authorization: Bearer <token>
     */
    public function handle(Request $request, Closure $next): Response
    {
        $header = $request->header('Authorization');

        if (! $header || ! str_starts_with($header, 'Bearer ')) {
            return response()->json([
                'mensaje' => 'No autenticado. Falta el token JWT.',
            ], 401);
        }

        $token = substr($header, 7); // quita el prefijo "Bearer "

        $payload = JwtService::validar($token);

        if (! $payload) {
            return response()->json([
                'mensaje' => 'Token inválido o expirado.',
            ], 401);
        }

        // Se deja el payload disponible dentro del request
        // por si el controlador siguiente necesita saber quién es el usuario
        $request->attributes->set('usuario_jwt', $payload);

        return $next($request);
    }
}
