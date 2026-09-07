<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoControllerSwagger;


Route::get('/proyectos', [ProyectoControllerSwagger::class, 'index']);
Route::get('/proyectos/{proye}', [ProyectoControllerSwagger::class, 'show']);
Route::post('/proyectos', [ProyectoControllerSwagger::class, 'store']);
