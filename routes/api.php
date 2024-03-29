<?php

use App\Http\Controllers\productsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);
Route::post('/addproduct',[productsController::class,'addProduct']);
Route::get('/list',[productsController::class,'list']);
Route::delete('/delete/{id}',[productsController::class,'delete']);
Route::get('/getProduct/{id}',[productsController::class,'item']);
Route::get('search/{key}',[productsController::class,'search']);
