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

    #[OA\Post(
        path: '/proyectos',
        summary: 'Crear un Proyecto',
        tags: ['Proyectos'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['nombre', 'fecha_inicio', 'estado', 'responsable', 'monto', 'created_by'],
                properties: [
                    new OA\Property(property: 'nombre', type: 'string', example: 'Proyecto'),
                    new OA\Property(property: 'fecha_inicio', type: 'string', format: 'date', example: '2026-02-12'),
                    new OA\Property(property: 'estado', type: 'string', example: 'activo'),
                    new OA\Property(property: 'responsable', type: 'string', example: 'El mismisimo'),
                    new OA\Property(property: 'monto', type: 'number', example: 200000),
                    new OA\Property(property: 'created_by', type: 'integer', example: 1)
                ]
            )
        ),

        responses: [
            new OA\Response(
                response: 201,
                description: 'Proyecto creado con éxito'
            ),
            new OA\Response(
                response: 422,
                description: 'Datos de validación incorrectos'
            )
        ]

    )]

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'estado' => 'required|string|max:50',
            'responsable' => 'required|string|max:255',
            'monto' => 'required|numeric|min:0',
            'created_by' => 'required|integer|exists:usuarios,id',
        ]);

        $proyecto = Proyecto::create($validatedData);

        return response()->json($proyecto, 201);
    }

    #[OA\Put(
       path: '/proyectos/{id}',
       summary: 'Actualizar un proyecto existente',
       tags: ['Proyectos'],
       parameters: [
           new OA\Parameter(
               name: 'id',
               in: 'path',
               required: true,
               description: 'ID del proyecto a actualizar',
               schema: new OA\Schema(type: 'integer')
           )
       ],
       requestBody: new OA\RequestBody(
           required: true,
           content: new OA\JsonContent(
               properties: [
                   new OA\Property(property: 'nombre', type: 'string', example: 'Proyecto'),
                   new OA\Property(property: 'fecha_inicio', type: 'string', format: 'date', example: '2026-02-12'),
                   new OA\Property(property: 'estado', type: 'string', example: 'activo'),
                   new OA\Property(property: 'responsable', type: 'string', example: 'El mismisimo'),
                   new OA\Property(property: 'monto', type: 'number', example: 200000)
               ]
           )
       ),
       responses: [
           new OA\Response(
               response: 200,
               description: 'tamo redi con las actu'
           ),
           new OA\Response(
               response: 404,
               description: 'no eta'
           ),
           new OA\Response(
               response: 422,
               description: 'error de clase 8 papi'
           )
       ]
   )]
   public function update(Request $request, $id)
   {
       $proyecto = Proyecto::find($id);


       if (!$proyecto) {
           return response()->json([
               'message' => 'na nai no estai'
           ], 404);
       }


       $validated = $request->validate([
           'nombre' => 'sometimes|required|string|max:255',
           'fecha_inicio' => 'sometimes|required|date',
           'estado' => 'sometimes|required|string|max:50',
           'responsable' => 'sometimes|required|string|max:255',
           'monto' => 'sometimes|required|numeric|min:0',
       ]);


       $proyecto->update($validated);


       return response()->json([
           'message' => 'tamo bien se actualizo to',
           'data'    => $proyecto
       ], 200);
   }

   #[OA\Delete(
       path: '/proyectos/{id}',
       summary: 'Eliminar un proyecto por ID',
       tags: ['Proyectos'],
       parameters: [
           new OA\Parameter(
               name: 'id',
               in: 'path',
               required: true,
               description: 'ID del proyecto a eliminar',
               schema: new OA\Schema(type: 'integer')
           )
       ],
       responses: [
           new OA\Response(
               response: 200,
               description: 'se muricio solo D:'
           ),
           new OA\Response(
               response: 404 ,
               description: 'no eta'
           )
       ]
   )]
   public function destroy($id)
   {
       $proyecto = Proyecto::find($id);


       if (!$proyecto) {
           return response()->json([
               'message' => 'na nai no estai'
           ], 404);
       }


       $proyecto->delete();


       return response()->json([
           'message' => 'se muricio solo D:'
       ], 200);
   }
}