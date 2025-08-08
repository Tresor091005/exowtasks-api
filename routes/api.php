<?php

use App\Models\Equipe;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\EquipeController;
use App\Http\Controllers\Api\V1\MembreController;
use App\Http\Controllers\Api\V1\TacheController;
use App\Http\Controllers\Api\V1\AuthController;

// Version 1 de l'API
Route::prefix('v1')->group(function () {

    // Authentification
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
        Route::get('user', [AuthController::class, 'user'])->middleware('auth:sanctum');
    });

    Route::middleware('auth:sanctum')->group(function () {

        // Routes pour tous les membres
        Route::get('teams', [EquipeController::class, 'index'])->middleware('can:viewAny,'.Equipe::class);
        Route::get('teams/{team}', [EquipeController::class, 'show']);

        Route::get('members', [MembreController::class, 'index']);
        Route::get('members/{member}', [MembreController::class, 'show']);

        Route::put('members/{member}', [MembreController::class, 'update']); // spécifique au membre

        Route::get('tasks', [TacheController::class, 'index']);
        Route::get('tasks/{task}', [TacheController::class, 'show']);
        Route::put('tasks/{task}', [TacheController::class, 'update']); // membres assignés et créateur

        // Routes réservées aux managers
        Route::middleware('check.manager')->group(function () {
            Route::post('teams', [EquipeController::class, 'store']);
            Route::put('teams/{team}', [EquipeController::class, 'update']);
            Route::delete('teams/{team}', [EquipeController::class, 'destroy']);

            Route::post('members', [MembreController::class, 'store']);
            Route::delete('members/{member}', [MembreController::class, 'destroy']);

            Route::post('tasks', [TacheController::class, 'store']);
            Route::delete('tasks/{task}', [TacheController::class, 'destroy']);

            Route::post('tasks/{task}/assign', [TacheController::class, 'assign']);
            Route::delete('tasks/{task}/unassign', [TacheController::class, 'unassign']);
        });
    });
});

// NOTE : Les managers peuvent altérer les informations d'une autre Equipe
// Tout le monde peut voir les tâches des autres teams
