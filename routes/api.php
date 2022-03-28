<?php

use App\Http\Controllers\PatientController;
use App\Models\City;
use App\Models\Patient;
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


Route::post('login',[PatientController::class , 'login']);

Route::middleware('auth:user-api')->group(function(){
    Route::get('logout',[PatientController::class , 'logout']);
});

