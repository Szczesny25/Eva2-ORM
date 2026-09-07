<?php


namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class ProyectoControllerSwagger extends Controller
{
    #[OA\Get( 
        path: '/proyectos/{proye}',
        summary: 'Obtiene un proyecto por su ID.',
        tags: ['Proyectos'],
        parameters: [
            new OA\Parameter(
                name: 'proye',
                in: 'path',
                required: true,
                description: 'ID del proyecto',
                schema: new OA\Schema(type: 'string')   
            )    
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Proyecto obtenido con éxito'
            ),
            new OA\Response(
                response: 404,
                description: 'Proyecto no encontrado'
            )
        ]

    )]
    public function show(Request $request, Proyecto $proye)
    {
        return response()->json($proye);
    }

    #[OA\Get(
        path: '/proyectos',
        summary: 'Lista los proyectos registrados.',
        tags: ['Proyectos'],
        parameters: [
            new OA\Parameter(
                name: 'limit',
                in: 'query',
                required: false,
                description: 'Cantidad de registros (por defecto 20)',
                schema: new OA\Schema(type: 'integer')
            ),
            new OA\Parameter(
                name: 'offset',
                in: 'query',
                required: false,
                description: 'Desplazamiento de registros (por defecto 0)',
                schema: new OA\Schema(type: 'integer')
            )

        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Lista obtenida con éxito'
            )
        ]
    )]
    public function index(Request $request)
    {
        $limit = min(max((int) $request->query('limit', 20), 1), 100);
        $offset = max((int) $request->query('offset', 0), 0);

        $proyectos = Proyecto::orderByDesc('created_at')
            ->offset($offset)
            ->limit($limit)
            ->get();

        return response()->json($proyectos);
    }
}
