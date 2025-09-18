<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//ruta a la pagina de oportunidades
Route::get('/clientes', function () {
    return view('lista_cliente');
});

//ruta a la pagina de oportunidades
Route::get('/oportunidades', function () {
    return view('lista_oportunidad');
});


