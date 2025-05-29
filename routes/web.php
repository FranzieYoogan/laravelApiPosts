<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;

// Rota de teste
Route::get('/ping', function () {
    return response()->json(['message' => 'pong']);
});

// Rotas REST para o controller Post
Route::apiResource('/posts', PostController::class);
