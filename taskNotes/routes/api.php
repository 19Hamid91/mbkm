<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiNotesController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/notes', [ApiNotesController::class, 'index']);
Route::post('/notes', [ApiNotesController::class, 'store']);
Route::get('/notes/{id}', [ApiNotesController::class, 'show']);
Route::put('/notes/{id}', [ApiNotesController::class, 'update']);
Route::delete('/notes/{id}', [ApiNotesController::class, 'destroy']);