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


// // // //
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/contratistas', [ApiController::class, 'all_contratistas']);
    Route::get('/contratistas/{id}', [ApiController::class, 'get_contratistas_id']);
    Route::get('/vehiculos', [ApiController::class, 'all_vehiculos']);
    Route::get('/vehiculos_x_contratista/{id}', [ApiController::class, 'vehiculos_x_contratista']);
    Route::get('/documentos', [ApiController::class, 'all_documentos']);
    Route::get('/documentos_x_contratista/{id}', [ApiController::class, 'documentos_x_contratista']);
});