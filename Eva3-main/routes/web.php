<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProyectoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Registro de usuario
Route::get('/registro', [AuthController::class, 'mostrarRegistro'])->name('registro');
Route::post('/registro', [AuthController::class, 'registrar'])->name('registro.guardar');

// Inicio de sesión de usuario
Route::get('/login', [AuthController::class, 'mostrarLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.autenticar');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Proyectos: protegidos con el JWT guardado en sesión al iniciar sesión
Route::middleware('jwt.web')->group(function () {
    Route::get('/proyectos', [ProyectoController::class, 'index'])->name('proyectos.index');
    Route::get('/proyectos/crear', [ProyectoController::class, 'crear'])->name('proyectos.crear');
    Route::post('/proyectos', [ProyectoController::class, 'guardar'])->name('proyectos.guardar');
    Route::get('/proyectos/{proyecto}/editar', [ProyectoController::class, 'editar'])->name('proyectos.editar');
    Route::put('/proyectos/{proyecto}', [ProyectoController::class, 'actualizar'])->name('proyectos.actualizar');
    Route::delete('/proyectos/{proyecto}', [ProyectoController::class, 'eliminar'])->name('proyectos.eliminar');
});
