<?php

use App\Http\Controllers\MenuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\TableController;

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

Route::group(['prefix'=>'v1'],function(){
    Route::get('tables/available', [TableController::class,'checkAvailability']);
    Route::post('tables/reserve', [TableController::class,'reserve']);
    Route::post('tables/{id}/order', [TableController::class,'order']);
    Route::get('tables/{table_id}/orders/{order_id}/checkout', [TableController::class,'checkout']);
    Route::get('menu', [MenuController::class,'listMeals']);    
});
