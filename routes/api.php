<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoControllerSwagger;


// Ruta para listar pokémons (index)
Route::get('/api/proyectos', [ProyectoControllerSwagger::class, 'index']);


// Ruta para ver un pokémon específico (show)
Route::get('/api/proyectos/{proye}', [ProyectoControllerSwagger::class, 'show']);
