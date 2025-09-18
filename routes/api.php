<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\OportunidadController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// Ruta de Clientes 
Route::apiResource('clientes', ClienteController::class);



Route::get('oportunidades/export', [OportunidadController::class, 'export'])
    ->name('oportunidades.export');

Route::apiResource('oportunidades', OportunidadController::class)->only([
    'index', 'store'
]);