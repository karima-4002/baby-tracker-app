<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MilestoneController;
use App\Http\Controllers\Api\MealController;

// Routes publiques
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Routes protégées - VERSION SIMPLIFIÉE POUR TEST
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    
    // Milestones
    Route::get('/milestones', [MilestoneController::class, 'index']);
    Route::post('/milestones', [MilestoneController::class, 'store']);
    Route::put('/milestones/{milestone}', [MilestoneController::class, 'update']);
    Route::delete('/milestones/{milestone}', [MilestoneController::class, 'destroy']);
    
    // Meals
    Route::get('/meals', [MealController::class, 'index']);
    Route::post('/meals', [MealController::class, 'store']);
    Route::put('/meals/{meal}', [MealController::class, 'update']);
    Route::delete('/meals/{meal}', [MealController::class, 'destroy']);
});

// Route de test sans auth
Route::get('/', function () {
    return response()->json([
        'message' => '✅ API Baby Tracker fonctionne !',
        'version' => '1.0.0',
    ]);
});