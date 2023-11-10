<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DirekturController;
use App\Http\Controllers\DosbingController;
use App\Http\Controllers\KajurController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\MbkmController;
use App\Http\Controllers\PemlapController;
use App\Http\Controllers\LogbookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('/kajur/acc/{id}', [KajurController::class, 'acc']);
Route::get('/kaprodi/acc/{id}', [KaprodiController::class, 'acc']);
Route::get('/mbkm/info/{id}', [MbkmController::class, 'info']);
Route::get('/mbkm/logbooks/{id}', [MbkmController::class, 'deleteLogbooks']);
Route::get('/pimpinan/acc/{id}', [DirekturController::class, 'acc']);
Route::get('/dosbing/logbook/{id}', [DosbingController::class, 'getLogbook']);
Route::get('/dosbing/{type}/{id}/acc', [DosbingController::class, 'acc']);
Route::get('/pemlap/{type}/{id}/acc', [PemlapController::class, 'acc']);
Route::get('/forget/{email}', [AuthController::class, 'resetPassword']);
Route::get('/getDosen/{role}', [AdminController::class, 'getDataDosen']);
Route::get('/changeToDosen/{id}/{source}', [AdminController::class, 'changeToDosen']);
Route::get('/getAllDosen/{jenis}', [AdminController::class, 'getAllDosen']);
Route::get('/updateDataDosen/{nip}', [AdminController::class, 'updateDataDosen']);
Route::get('/pimpinan/dataAll/{tahun}', [DirekturController::class, 'dataAll']);
Route::get('/pimpinan/dataJurusan/{tahun}/{jurusan}', [DirekturController::class, 'dataJurusan']);
Route::get('/pimpinan/dataProdi/{tahun}/{prodi}', [DirekturController::class, 'dataProdi']);
Route::get('/pimpinan/dataTabel/{tahun}/{prodi}', [DirekturController::class, 'dataTabel']);
Route::post('/dosbing/status/{id}', [DosbingController::class, 'updateStatus']);
Route::post('/dosbing/statusex/{id}', [DosbingController::class, 'updateStatusex']);
Route::post('/dosbing/editbody/{id}', [MbkmController::class, 'updateBody']);
Route::post('/sso-login', [AuthController::class, 'loginActSSO']);
Route::get('/getLogbook/{id}', [LogbookController::class, 'getLogbook']);
Route::post('/setDosbing', [KaprodiController::class, 'setDosbing']);
Route::post('/admin/deletePic/{id}', [AdminController::class, 'deletePic']);
Route::post('/admin/deleteJurusan/{id}', [AdminController::class, 'deleteJurusan']);
Route::post('/admin/deleteProdi/{id}', [AdminController::class, 'deleteProdi']);