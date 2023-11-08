<?php

use App\Http\Controllers\NotesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('index');
});

Route::get('/index', [NotesController::class, 'index']);
Route::get('/create', [NotesController::class, 'create']);
Route::post('/store', [NotesController::class, 'store']);
Route::get('/show/{id}', [NotesController::class, 'show']);
Route::get('/edit/{id}', [NotesController::class, 'edit']);
Route::put('/update/{id}', [NotesController::class, 'update']);
Route::delete('/delete/{id}', [NotesController::class, 'destroy']);
