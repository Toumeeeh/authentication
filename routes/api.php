<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;

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


Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::get('/products/search/{name}', [ProductController::class,'search']);
    Route::post('/logout', [AuthController::class,'logout']);
    Route::delete('/delete/{id}', [ProductController::class,'destroy']);

 });
Route::put('/update/{id}', [ProductController::class,'update']);
Route::get('/products', [ProductController::class,'index']);
Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);
Route::post('/create', [ProductController::class,'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});
