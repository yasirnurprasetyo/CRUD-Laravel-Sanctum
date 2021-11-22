<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\FormController;
use App\Http\Controllers\API\ScoresController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'auth:sanctum'], function (){
    //crud
    Route::post('/create', [FormController::class, 'create']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/edit/{id}', [FormController::class, 'edit']);
    Route::post('/edit/{id}', [FormController::class, 'update']);
    Route::get('/delete/{id}', [FormController::class, 'delete']);
    //relasi 
    Route::post('/create-scores-student', [ScoresController::class, 'create']);
    Route::get('/data-student/{id}', [ScoresController::class, 'getStudent']);
    Route::post('/data-student/{id}', [ScoresController::class, 'update']);
});

Route::post('/login', [AuthController::class, 'login']);
