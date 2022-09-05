<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'auth']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::controller(MahasiswaController::class)->middleware('auth')->group(function () {
    Route::get('/dashboard',  'index');
    Route::post('/dashboard', 'store');
    Route::get('/dashboard/{list}/edit', 'edit');
    Route::put('/dashboard/{list}', 'update');
    Route::delete('/dashboard/{list}', 'destroy');
});

Route::controller(AdminController::class)->middleware('auth')->group(function () {
    Route::get('/dashboard/mahasiswa', 'index');
    Route::post('/dashboard/mahasiswa', 'store');
    Route::get('/dashboard/mahasiswa/{user}/edit', 'edit');
    Route::put('/dashboard/mahasiswa/{user}', 'update');
    Route::delete('/dashboard/mahasiswa/{user}', 'destroy');

    Route::get('/dashboard/mataKuliah', 'indexMatkul');
    Route::post('/dashboard/mataKuliah', 'storeMatkul');
    Route::get('/dashboard/mataKuliah/{matkul}/edit', 'editMatkul');
    Route::put('/dashboard/mataKuliah/{matkul}', 'updateMatkul');
    Route::delete('/dashboard/mataKuliah/{matkul}', 'destroyMatkul');
});
