<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TesteController;

// Rota de teste (adicionei esta linha nova)
Route::get('/rota-teste', TesteController::class);

// Rotas originais do Laravel (não altere estas)
Route::get('/', function () {
    return view('welcome');
});