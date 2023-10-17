<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::post('/livros', [BookController::class, 'create']);

Route::get('/livros', [BookController::class, 'getAll']);

Route::get('/livros/{id}', [BookController::class, 'getById']);

Route::put('/livros/{id}', [BookController::class, 'updateById']);

Route::delete('/livros/{id}', [BookController::class, 'deleteById']);
