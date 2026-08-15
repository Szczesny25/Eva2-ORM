<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Lista los proyectos creados por el usuario autenticado (según el JWT).
     */
    public function index(Request $request)
    {
        $usuarioJwt = $request->attributes->get('usuario_jwt');

        $proyectos = Proyecto::where('created_by', $usuarioJwt['id'])
            ->orderByDesc('created_at')
            ->get();

        return view('proyectos.index', [
            'proyectos' => $proyectos,
            'usuarioJwt' => $usuarioJwt,
        ]);
    }

    /**
     * Muestra el formulario para crear un proyecto.
     */
    public function crear()
    {
        return view('proyectos.crear');
    }

    /**
     * Guarda un nuevo proyecto asociado al usuario autenticado.
     */
    public function guardar(Request $request)
    {
        $usuarioJwt = $request->attributes->get('usuario_jwt');

        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'estado' => 'required|string|max:255',
            'responsable' => 'required|string|max:255',
            'monto' => 'required|numeric|min:0',
        ]);

        $datos['created_by'] = $usuarioJwt['id'];

        Proyecto::create($datos);

        return redirect()->route('proyectos.index');
    }

    /**
     * Muestra el formulario para editar un proyecto existente.
     */
    public function editar(Request $request, Proyecto $proyecto)
    {
        $usuarioJwt = $request->attributes->get('usuario_jwt');

        if ($proyecto->created_by != $usuarioJwt['id']) {
            abort(403);
        }

        return view('proyectos.editar', [
            'proyecto' => $proyecto,
        ]);
    }

    /**
     * Actualiza un proyecto existente.
     */
    public function actualizar(Request $request, Proyecto $proyecto)
    {
        $usuarioJwt = $request->attributes->get('usuario_jwt');

        if ($proyecto->created_by != $usuarioJwt['id']) {
            abort(403);
        }

        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'estado' => 'required|string|max:255',
            'responsable' => 'required|string|max:255',
            'monto' => 'required|numeric|min:0',
        ]);

        $proyecto->update($datos);

        return redirect()->route('proyectos.index');
    }

    /**
     * Elimina un proyecto existente.
     */
    public function eliminar(Request $request, Proyecto $proyecto)
    {
        $usuarioJwt = $request->attributes->get('usuario_jwt');

        if ($proyecto->created_by != $usuarioJwt['id']) {
            abort(403);
        }

        $proyecto->delete();

        return redirect()->route('proyectos.index');
    }
}
