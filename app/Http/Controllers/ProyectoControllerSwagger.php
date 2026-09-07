<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use OpenApi\Attributes as OA;

class ProyectoControllerSwagger extends Controller
{
    #[OA\Get( 
        path: '/api/proyectos',
        summary: 'Lista los proyectos creados por el usuario autenticado (según el JWT).',
        tags: ['Proyectos'],
        parameters: [
            new OA\parameter(
                name: 'name',
                in: 'path',
                Required: true,
                description: 'hola',
                schema: new OA\Schema(type: 'string')   
            )    
        ],
        response: [
            new OA\Response(
                response: 200,
                description: 'tamo redi pa lo redi'
            ),
            new OA\Response(
                response: 404,
                description: 'no eta mano checa eso'
            )
        ]

    )]
    public function show($proye)
    {
        $response = Http::get("/api/proyectos/{$proye}");
        if ($response->failed()) {
            return response()->json([
                'message' => 'no esta pai checa eso bro'
            ], 404);
        } 

        $data = $response->json();

        $laPosta = [
            'nombre' => $data['nombre'],
            'fecha_inicio' => $data['fecha_inicio'],
            'estado' => $data['estado'],
            'responsable' => $data['responsable'],
            'monto' => $data['monto']
        ];

        return response()->json($laPosta, 200);
    }
}