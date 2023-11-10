<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DirekturController;
use App\Http\Controllers\DosbingController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\KajurController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\MbkmController;
use App\Http\Controllers\PemlapController;
use App\Http\Controllers\PicController;
use Illuminate\Support\Facades\Artisan;
use App\Models\Logbook;
use App\Models\Mbkm;
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

Route::get('/clear-route-cache', function () {
    Artisan::call('route:cache');
    return 'Routes cache has clear successfully !';
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('login-act', [AuthController::class, 'loginAct']);
Route::get('regis', [AuthController::class, 'regis']);
Route::post('regis-act', [AuthController::class, 'regisAct']);
Route::get('email-ver/{token}', [AuthController::class, 'verEmail']);
Route::get('forget', [AuthController::class, 'forget']);
Route::get('forget-form/{token}', [AuthController::class, 'forgetForm']);
Route::post('forget-act', [AuthController::class, 'forgetAct']);
Route::group(['middleware' => ['auth']], function () {
    Route::get('mbkm/show-support/{id}', [MbkmController::class, 'showSupport']);
    Route::get('/change-pass/{pass}/{pass_old}/{pass_ver}', [AuthController::class, 'changePassword']);
    Route::get('/', function () {
        return redirect('/login');
    });
    Route::get('logout', [AuthController::class, 'logout']);
    Route::group(['middleware' => ['verEmail', 'checkMahasiswa']], function () {
        Route::prefix('mbkm')->group(function () {
            Route::controller(MbkmController::class)->group(function () {
                Route::get('/out', 'out');
                Route::get('/in', 'in');
                Route::get('/regis', 'regis');
                Route::get('/support/{id}', 'support');
                Route::post('/support/act', 'supportAct');
                Route::post('/register', 'register');
                // Route::get('/show-support/{id}', 'showSupport');
                Route::get('/show-form', 'showForm');
                Route::post('/logbook', 'logbook');
                Route::post('/report', 'report');
                Route::post('/report/edit', 'reportEdit');
                Route::post('/form', 'form');
                Route::get('/save/{id}', 'save');
                Route::get('/sk/{id}', 'sk');
                Route::get('/template/{jenis}', 'template');
                Route::post('/add/pemlap', 'pemlabAdd');
            });
        });
        Route::prefix('logbook')->group(function () {
            Route::controller(LogbookController::class)->group(function () {
                Route::get('/', 'logbook');
            });
        });
        Route::get('history', [MbkmController::class, 'history']);
    });

    Route::group(['middleware' => ['checkKaprodi']], function () {
        Route::get('/exportprodi', [FileController::class, 'exportCSV']);
        Route::prefix('kaprodi')->group(function () {
            Route::controller(KaprodiController::class)->group(function () {
                Route::get('/', 'index');
                Route::post('/acc', 'acc');
                // Route::post('/setDosbing', 'setDosbing');
            });
        });
    });
    Route::group(['middleware' => 'checkDosbing'], function () {
        Route::prefix('dosbing')->group(function () {
            Route::controller(DosbingController::class)->group(function () {
                Route::get('/', 'index');
                Route::get('/logbook', 'logbook');
                Route::get('/report', 'report');
                Route::post('/nilai', 'nilai');
                // Route::post('/acc', 'acc');
            });
        });
    });
    Route::group(['middleware' => 'checkPemlap'], function () {
        Route::prefix('pemlap')->group(function () {
            Route::controller(PemlapController::class)->group(function () {
                Route::get('/', 'index');
                Route::get('/logbook', 'logbook');
                Route::get('/report', 'report');
                Route::post('/nilai', 'nilai');
                // Route::post('/acc', 'acc');
            });
        });
    });

    Route::group(['middleware' => 'checkKajur'], function () {
        Route::get('/exportkajur', [FileController::class, 'exportCSV']);
        Route::prefix('kajur')->group(function () {
            Route::controller(KajurController::class)->group(function () {
                Route::get('/', 'index');
            });
        });
    });
    Route::group(['middleware' => 'checkDirektur'], function () {
        Route::get('/export', [FileController::class, 'exportCSV']);
        Route::prefix('pimpinan')->group(function () {
            Route::controller(DirekturController::class)->group(function () {
                Route::get('/', 'dashboard');
                Route::get('/data', 'index');
                Route::prefix('pimpinan')->group(function () {
                });
            });
        });
    });
    Route::group(['middleware' => 'checkAdmin'], function () {
        Route::prefix('admin')->group(function () {
            Route::controller(AdminController::class)->group(function () {
                Route::get('/', 'index');
                Route::get('/getDosen', 'getDataDosen');
                Route::post('/changerole', 'changeRole');
                Route::get('/dosens', 'dosens');
                Route::get('/pic', 'pic');
                Route::post('/addPic', 'addPic');
                Route::post('/deletePic', 'deletePic');
                Route::get('/jurusan', 'jurusan');
                Route::post('/addJurusan', 'addJurusan');
                Route::get('/prodi', 'prodi');
                Route::post('/addProdi', 'addProdi');
                Route::post('/editProdi', 'editProdi');
            });
        });
    });
    Route::group(['middleware' => 'checkPic'], function () {
        Route::prefix('pic')->group(function (){
            Route::controller(PicController::class)->group(function () {
                Route::get('/', 'index');
                Route::post('/nilai', 'nilai');
                Route::post('/setsk', 'setsk');
                
            });
        });
    });
});
