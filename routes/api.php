<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\KategoriController;

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

Route::get('kategori', [KategoriController::class, 'index']);
Route::post('kategori/store', [KategoriController::class, 'store']);
Route::get('kategori/show/{id}', [KategoriController::class, 'show']);
Route::post('kategori/update/{id}', [KategoriController::class, 'update']);
Route::delete('kategori/destroy/{id}', [KategoriController::class, 'destroy']);

Route::get('produk', [ProdukController::class, 'index']);
Route::post('produk/store', [ProdukController::class, 'store']);
Route::get('produk/show/{id}', [ProdukController::class, 'show']);
Route::post('produk/update/{id}', [ProdukController::class, 'update']);
Route::delete('produk/destroy/{id}', [ProdukController::class, 'destroy']);
