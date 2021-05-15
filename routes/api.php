<?php

use App\Http\Controllers\Api\DictionaryController;
use App\Http\Controllers\Api\WordForUserController;
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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    
});
Route::apiResource('dictionary',DictionaryController::class);
Route::post('save_word/{wordId}/{userId}',[WordForUserController::class,'store_word_for_user'])->name('word.store');