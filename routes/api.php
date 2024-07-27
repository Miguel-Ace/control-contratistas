<?php

use App\Http\Controllers\api\ApiController;
use App\Http\Controllers\api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/login',[AuthController::class, 'login']);


// User
Route::get('/users', [ApiController::class, 'all_user']);
Route::get('/users_x_id/{id}', [ApiController::class, 'get_user_id']);
Route::get('/users_x_id_x_campo/{id}/{campo}', [ApiController::class, 'getUserNameById']);
Route::post('/users', [ApiController::class, 'insert_user']);
Route::patch('/users/update/{id}', [ApiController::class, 'update_user']);
Route::delete('/users/delete/{id}', [ApiController::class, 'delete_user']);

// Cantón
Route::get('/cantones', [ApiController::class, 'all_cantones']);

// Provincia
Route::get('/provincias', [ApiController::class, 'all_provincia']);

// Contratista
Route::get('/contratistas', [ApiController::class, 'all_contratistas']);
Route::get('/contratistas_x_id/{id}', [ApiController::class, 'get_contratistas_id']);
Route::get('/contratistas_x_id_x_campo/{id}/{campo}', [ApiController::class, 'getContratistasNameById']);
Route::post('/contratistas/{user}', [ApiController::class, 'insert_contratistas']);
Route::patch('/contratistas/update/{id}', [ApiController::class, 'update_contratistas']);
Route::patch('/contratistas/update/activo/{id}', [ApiController::class, 'update_contratistas_activo']);
Route::delete('/contratistas/delete/{id}', [ApiController::class, 'delete_contratistas']);

// Tipo equipo
Route::get('/tipos_equipos', [ApiController::class, 'all_tipos_equipos']);
Route::get('/tipos_equipos_x_id/{id}', [ApiController::class, 'get_tipos_equipos_id']);
Route::get('/tipos_equipos_x_id_x_campo/{id}/{campo}', [ApiController::class, 'getTipos_equiposNameById']);
Route::post('/tipos_equipos', [ApiController::class, 'insert_tipos_equipos']);
Route::patch('/tipos_equipos/update/{id}', [ApiController::class, 'update_tipos_equipos']);
Route::delete('/tipos_equipos/delete/{id}', [ApiController::class, 'delete_tipos_equipos']);

// Tipo documento
Route::get('/tipos_documentos', [ApiController::class, 'all_tipos_documentos']);
Route::get('/tipos_documentos_x_id/{id}', [ApiController::class, 'get_tipos_documentos_id']);
Route::get('/tipos_documentos_x_id_x_campo/{id}/{campo}', [ApiController::class, 'getTipos_documentosNameById']);
Route::post('/tipos_documentos', [ApiController::class, 'insert_tipos_documentos']);
Route::patch('/tipos_documentos/update/{id}', [ApiController::class, 'update_tipos_documentos']);
Route::delete('/tipos_documentos/delete/{id}', [ApiController::class, 'delete_tipos_documentos']);

// Tipo cédula
Route::get('/tipos_cedulas', [ApiController::class, 'all_tipos_cedulas']);
Route::get('/tipos_cedulas_x_id/{id}', [ApiController::class, 'get_tipos_cedulas_id']);
Route::get('/tipos_cedulas_x_id_x_campo/{id}/{campo}', [ApiController::class, 'getTipos_cedulasNameById']);
Route::post('/tipos_cedulas', [ApiController::class, 'insert_tipos_cedulas']);
Route::patch('/tipos_cedulas/update/{id}', [ApiController::class, 'update_tipos_cedulas']);
Route::delete('/tipos_cedulas/delete/{id}', [ApiController::class, 'delete_tipos_cedulas']);

// Equipo
Route::get('/equipos', [ApiController::class, 'all_equipos']);
Route::get('/equipos_x_id/{id}', [ApiController::class, 'get_equipos_id']);
Route::get('/equipos_x_id_x_campo/{id}/{campo}', [ApiController::class, 'getEquiposNameById']);
Route::post('/equipos', [ApiController::class, 'insert_equipos']);
Route::patch('/equipos/update/{id}', [ApiController::class, 'update_equipos']);
Route::delete('/equipos/delete/{id}', [ApiController::class, 'delete_equipos']);

// Documento
Route::get('/documentos', [ApiController::class, 'all_documentos']);
Route::get('/documentos_x_id/{id}', [ApiController::class, 'get_documentos_id']);
Route::get('/documentos_x_id_x_campo/{id}/{campo}', [ApiController::class, 'getDocumentosNameById']);
Route::post('/documentos', [ApiController::class, 'insert_documentos']);
Route::patch('/documentos/update/{id}', [ApiController::class, 'update_documentos']);
Route::delete('/documentos/delete/{id}', [ApiController::class, 'delete_documentos']);

// Vehiculo
Route::get('/vehiculos', [ApiController::class, 'all_vehiculos']);
Route::get('/vehiculos_x_id/{id}', [ApiController::class, 'get_vehiculos_id']);
Route::get('/vehiculos_x_id_x_campo/{id}/{campo}', [ApiController::class, 'getVehiculosNameById']);
Route::post('/vehiculos', [ApiController::class, 'insert_vehiculos']);
Route::patch('/vehiculos/update/{id}', [ApiController::class, 'update_vehiculos']);
Route::delete('/vehiculos/delete/{id}', [ApiController::class, 'delete_vehiculos']);

// Empleado
Route::get('/empleados', [ApiController::class, 'all_empleados']);
Route::get('/empleados_x_id/{id}', [ApiController::class, 'get_empleados_id']);
Route::get('/empleados_x_id_x_campo/{id}/{campo}', [ApiController::class, 'getEmpleadosNameById']);
Route::post('/empleados', [ApiController::class, 'insert_empleados']);
Route::patch('/empleados/update/{id}', [ApiController::class, 'update_empleados']);
Route::delete('/empleados/delete/{id}', [ApiController::class, 'delete_empleados']);

// Route::middleware(['auth:sanctum'])->group(function () {
// });