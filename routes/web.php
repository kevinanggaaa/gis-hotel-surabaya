<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BintangController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\UserController;
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

Route::get('/', [WebController::class, 'index']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Kecamatan
Route::get('/kecamatan', [KecamatanController::class, 'index'])->name('kecamatan');
Route::get('/kecamatan/add', [KecamatanController::class, 'add']);
Route::post('/kecamatan/insert', [KecamatanController::class, 'insert']);
Route::get('/kecamatan/edit/{id_kecamatan}', [KecamatanController::class, 'edit']);
Route::post('/kecamatan/update/{id_kecamatan}', [KecamatanController::class, 'update']);
Route::get('/kecamatan/delete/{id_kecamatan}', [KecamatanController::class, 'delete']);

// Bintang
Route::get('/bintang', [BintangController::class, 'index'])->name('bintang');
Route::get('/bintang/add', [BintangController::class, 'add']);
Route::post('/bintang/insert', [BintangController::class, 'insert']);
Route::get('/bintang/edit/{id_bintang}', [BintangController::class, 'edit']);
Route::post('/bintang/update/{id_bintang}', [BintangController::class, 'update']);
Route::get('/bintang/delete/{id_bintang}', [BintangController::class, 'delete']);


// Hotel
Route::get('/hotel', [HotelController::class, 'index'])->name('hotel');
Route::get('/hotel/add', [HotelController::class, 'add']);
Route::post('/hotel/insert', [HotelController::class, 'insert']);
Route::get('/hotel/edit/{id_hotel}', [HotelController::class, 'edit']);
Route::post('/hotel/update/{id_hotel}', [HotelController::class, 'update']);
Route::get('/hotel/delete/{id_hotel}', [HotelController::class, 'delete']);

// User
Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('/user/add', [UserController::class, 'add']);
Route::post('/user/insert', [UserController::class, 'insert']);
Route::get('/user/edit/{id}', [UserController::class, 'edit']);
Route::post('/user/update/{id}', [UserController::class, 'update']);
Route::get('/user/delete/{id}', [UserController::class, 'delete']);

// Frontend
Route::get('/kecamatan/{id_kecamatan}', [WebController::class, 'kecamatan'])->name('kecamatan');
Route::get('/bintang/{id_bintang}', [WebController::class, 'bintang'])->name('bintang');
Route::get('/detailhotel/{id_hotel}', [WebController::class, 'detailhotel'])->name('detailhotel');
