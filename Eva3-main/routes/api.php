<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoControllerSwagger;


Route::get('/proyectos', [ProyectoControllerSwagger::class, 'index']);
Route::get('/proyectos/{proye}', [ProyectoControllerSwagger::class, 'show']);
Route::post('/proyectos', [ProyectoControllerSwagger::class, 'store']);
// El enunciado pide que la actualización funcione tanto con PUT como con PATCH.
Route::match(['put', 'patch'], '/proyectos/{proye}', [ProyectoControllerSwagger::class, 'update']);
Route::delete('/proyectos/{proye}', [ProyectoControllerSwagger::class, 'destroy']);
