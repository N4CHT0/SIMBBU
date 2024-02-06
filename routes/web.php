<?php

use App\Http\Controllers\DiklatMCController;
use App\Http\Controllers\DiklatMEFAController;
use App\Http\Controllers\DiklatSATController;
use App\Http\Controllers\DiklatSATSDSDController;
use App\Http\Controllers\DiklatSOUMController;
use App\Http\Controllers\DiklatSOURController;
use App\Http\Controllers\DiklatSRE1Controller;
use App\Http\Controllers\DiklatSRE2Controller;
use App\Http\Controllers\DiklatSSOController;
use App\Http\Controllers\PesertaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\DiklatGMDSSController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::get('/home/admin', [AdminController::class, 'showTotalPegawai'])
    ->name('admin.home')
    ->middleware(['auth', 'role:admin']);

// DATA PENGGUNA
Route::get('/users', function () {
    return view('auth.index');
})->name('auth.index')->middleware(['auth', 'role:admin']);
Route::resource('UsersAjax', AdminController::class)
    ->middleware(['auth', 'role:admin']);
/*
/*
|--------------------------------------------------------------------------
| Peserta Routes
|--------------------------------------------------------------------------
*/
Route::get('/home', [PesertaController::class, 'index'])
    ->name('peserta.home')
    ->middleware(['auth', 'role:peserta']);
/*
|--------------------------------------------------------------------------
| Pegawai Routes
|--------------------------------------------------------------------------
*/
Route::get('/pegawai', function () {
    return view('pegawai.index');
})->name('pegawai.index');
Route::resource('PegawaiAjax', PegawaiController::class);

/*
|--------------------------------------------------------------------------
| DIKLAT GMDSS Routes
|--------------------------------------------------------------------------
*/
Route::get('/diklat_gmdss', function () {
    return view('diklat_gmdss.index');
})->name('diklat_gmdss.index');
Route::resource('DiklatGMDSSAjax', DiklatGMDSSController::class);

/*
|--------------------------------------------------------------------------
| DIKLAT MC Routes
|--------------------------------------------------------------------------
*/
Route::get('/diklat_mc', function () {
    return view('diklat_mc.index');
})->name('diklat_mc.index');
Route::resource('DiklatMCAjax', DiklatMCController::class);

/*
|--------------------------------------------------------------------------
| DIKLAT MEFA Routes
|--------------------------------------------------------------------------
*/
Route::get('/diklat_mefa', function () {
    return view('diklat_mefa.index');
})->name('diklat_mefa.index');
Route::resource('DiklatMEFAAjax', DiklatMEFAController::class);

/*
|--------------------------------------------------------------------------
| DIKLAT SAT Routes
|--------------------------------------------------------------------------
*/
Route::get('/diklat_sat', function () {
    return view('diklat_sat.index');
})->name('diklat_sat.index');
Route::resource('DiklatSATAjax', DiklatSATController::class);

/*
|--------------------------------------------------------------------------
| DIKLAT SATSDSD Routes
|--------------------------------------------------------------------------
*/
Route::get('/diklat_satsdsd', function () {
    return view('diklat_satsdsd.index');
})->name('diklat_satsdsd.index');
Route::resource('DiklatSATSDSDAjax', DiklatSATSDSDController::class);

/*
|--------------------------------------------------------------------------
| DIKLAT SSO Routes
|--------------------------------------------------------------------------
*/
Route::get('/diklat_sso', function () {
    return view('diklat_sso.index');
})->name('diklat_sso.index');
Route::resource('DiklatSSOAjax', DiklatSSOController::class);

/*
|--------------------------------------------------------------------------
| DIKLAT SOUM Routes
|--------------------------------------------------------------------------
*/
Route::get('/diklat_soum', function () {
    return view('diklat_soum.index');
})->name('diklat_soum.index');
Route::resource('DiklatSOUMAjax', DiklatSOUMController::class);

/*
|--------------------------------------------------------------------------
| DIKLAT SOUR Routes
|--------------------------------------------------------------------------
*/
Route::get('/diklat_sour', function () {
    return view('diklat_sour.index');
})->name('diklat_sour.index');
Route::resource('DiklatSOURAjax', DiklatSOURController::class);

/*
|--------------------------------------------------------------------------
| DIKLAT SRE1 Routes
|--------------------------------------------------------------------------
*/
Route::get('/diklat_sre1', function () {
    return view('diklat_sre1.index');
})->name('diklat_sre1.index');
Route::resource('DiklatSRE1Ajax', DiklatSRE1Controller::class);

/*
|--------------------------------------------------------------------------
| DIKLAT SRE2 Routes
|--------------------------------------------------------------------------
*/
Route::get('/diklat_sre2', function () {
    return view('diklat_sre2.index');
})->name('diklat_sre2.index');
Route::resource('DiklatSRE2Ajax', DiklatSRE2Controller::class);

Auth::routes();
