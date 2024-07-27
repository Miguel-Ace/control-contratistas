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
    Route::get('/user/create', [CatalogoController::class, 'user_create']);
    Route::get('/user/view/{id}', [CatalogoController::class, 'user_view']);
    Route::get('/user/edit/{id}', [CatalogoController::class, 'user_edit']);
    Route::post('/user', [CatalogoController::class, 'user_store']);
    Route::patch('/user/{id}', [CatalogoController::class, 'user_update']);

    
    // Contratista
    Route::get('/contratistas', [CatalogoController::class, 'contratista_index']);
    Route::get('/contratistas/create', [CatalogoController::class, 'contratista_create']);
    Route::get('/contratistas/view/{id}', [CatalogoController::class, 'contratista_view']);
    Route::get('/contratistas/edit/{id}', [CatalogoController::class, 'contratista_edit']);
    Route::post('/contratistas', [CatalogoController::class, 'contratista_store']);
    Route::patch('/contratistas/{id}', [CatalogoController::class, 'contratista_update']);
    
    // Empleado
    Route::get('/contratistas/empleados/{contratista}', [CatalogoController::class, 'empleados_index']);
    Route::get('/contratistas/empleados/create/{contratista}', [CatalogoController::class, 'empleado_create']);
    Route::get('/contratistas/empleados/view/{id}', [CatalogoController::class, 'empleado_view']);
    Route::get('/contratistas/empleados/edit/{id}', [CatalogoController::class, 'empleado_edit']);
    Route::post('/contratistas/empleados/{contratista}', [CatalogoController::class, 'empleado_store']);
    Route::patch('/contratistas/empleados/{id}', [CatalogoController::class, 'empleado_update']);

    // Vehiculo
    Route::get('/contratistas/vehiculo/{contratista}', [CatalogoController::class, 'vehiculo_index']);
    Route::get('/contratistas/vehiculo/create/{contratista}', [CatalogoController::class, 'vehiculo_create']);
    Route::get('/contratistas/vehiculo/view/{id}', [CatalogoController::class, 'vehiculo_view']);
    Route::get('/contratistas/vehiculo/edit/{id}', [CatalogoController::class, 'vehiculo_edit']);
    Route::post('/contratistas/vehiculo/{contratista}', [CatalogoController::class, 'vehiculo_store']);
    Route::patch('/contratistas/vehiculo/{id}', [CatalogoController::class, 'vehiculo_update']);

    // Documento
    Route::get('/contratistas/documento/{contratista}', [CatalogoController::class, 'documento_index']);
    Route::get('/contratistas/documento/create/{contratista}', [CatalogoController::class, 'documento_create']);
    Route::get('/contratistas/documento/view/{id}', [CatalogoController::class, 'documento_view']);
    Route::get('/contratistas/documento/edit/{id}', [CatalogoController::class, 'documento_edit']);
    Route::post('/contratistas/documento/{contratista}', [CatalogoController::class, 'documento_store']);
    Route::patch('/contratistas/documento/{id}', [CatalogoController::class, 'documento_update']);

    // Equipo
    Route::get('/contratistas/equipo/{contratista}', [CatalogoController::class, 'equipo_index']);
    Route::get('/contratistas/equipo/create/{contratista}', [CatalogoController::class, 'equipo_create']);
    Route::get('/contratistas/equipo/view/{id}', [CatalogoController::class, 'equipo_view']);
    Route::get('/contratistas/equipo/edit/{id}', [CatalogoController::class, 'equipo_edit']);
    Route::post('/contratistas/equipo/{contratista}', [CatalogoController::class, 'equipo_store']);
    Route::patch('/contratistas/equipo/{id}', [CatalogoController::class, 'equipo_update']);

    // Tipo cédula
    Route::get('/tipos_cedulas', [CatalogoController::class, 'tipo_cedula_index']);
    Route::get('/tipos_cedulas/create', [CatalogoController::class, 'tipo_cedula_create']);
    Route::get('/tipos_cedulas/view/{id}', [CatalogoController::class, 'tipo_cedula_view']);
    Route::get('/tipos_cedulas/edit/{id}', [CatalogoController::class, 'tipo_cedula_edit']);
    Route::post('/tipos_cedulas', [CatalogoController::class, 'tipo_cedula_store']);
    Route::patch('/tipos_cedulas/{id}', [CatalogoController::class, 'tipo_cedula_update']);

    // Tipo documento
    Route::get('/tipos_documentos', [CatalogoController::class, 'tipo_documento_index']);
    Route::get('/tipos_documentos/create', [CatalogoController::class, 'tipo_documento_create']);
    Route::get('/tipos_documentos/view/{id}', [CatalogoController::class, 'tipo_documento_view']);
    Route::get('/tipos_documentos/edit/{id}', [CatalogoController::class, 'tipo_documento_edit']);
    Route::post('/tipos_documentos', [CatalogoController::class, 'tipo_documento_store']);
    Route::patch('/tipos_documentos/{id}', [CatalogoController::class, 'tipo_documento_update']);
    
    // Tipo equipo
    Route::get('/tipos_equipos', [CatalogoController::class, 'tipo_equipo_index']);
    Route::get('/tipos_equipos/create', [CatalogoController::class, 'tipo_equipo_create']);
    Route::get('/tipos_equipos/view/{id}', [CatalogoController::class, 'tipo_equipo_view']);
    Route::get('/tipos_equipos/edit/{id}', [CatalogoController::class, 'tipo_equipo_edit']);
    Route::post('/tipos_equipos', [CatalogoController::class, 'tipo_equipo_store']);
    Route::patch('/tipos_equipos/{id}', [CatalogoController::class, 'tipo_equipo_update']);
    
});