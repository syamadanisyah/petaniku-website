<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mobile\Fitur\LoginController;
use App\Http\Controllers\Mobile\Fitur\RegisterController;
use App\Http\Controllers\Mobile\Fitur\ProdukController;
use App\Http\Controllers\Mobile\Page\ProdukController AS ShowProdukController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/login', [LoginController::class, 'Login']);
Route::post('/register', [RegisterController::class, 'Register']);
Route::get('/produk', [ShowProdukController::class, 'index']);
Route::get('/kategori', [ShowProdukController::class, 'allCategory']);
Route::get('/kategorifil', [ShowProdukController::class, 'kategori']);
Route::post('/pesananbaru', [TransactionController::class, 'pesananSekarang']);