<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\catalogo\CatalogoController;
use Illuminate\Support\Facades\Route;

// Auntenticación
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'store']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // Home
    Route::get('/', [CatalogoController::class, 'contratista_index']);
    
    // Usuario
    Route::get('/user', [CatalogoController::class, 'user_index'])->name('user');
    
    // Contratista
    Route::get('/contratistas', [CatalogoController::class, 'contratista_index']);
    
    // Tipo equipo
    Route::get('/tipos_equipos', [CatalogoController::class, 'tipos_equipos_index']);
    
    // Tipo documento
    Route::get('/tipos_documentos', [CatalogoController::class, 'tipos_documentos_index']);
    
    // Tipo cédula
    Route::get('/tipos_cedulas', [CatalogoController::class, 'tipos_cedulas_index']);

    // Equipo
    Route::get('/contratistas/equipos', [CatalogoController::class, 'equipos_index']);

    // Documento
    Route::get('/contratistas/documentos', [CatalogoController::class, 'documentos_index']);

    // Vehiculo
    Route::get('/contratistas/vehiculos', [CatalogoController::class, 'vehiculos_index']);

    // Empleado
    Route::get('/contratistas/empleados', [CatalogoController::class, 'empleados_index']);
});