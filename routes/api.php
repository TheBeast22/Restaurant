<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;
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
Route::post("login",[UserController::class,"login"]);
Route::post("signup",[UserController::class,"register"]);


Route::get("restaurants/all",[RestaurantController::class,"index"]);
Route::get("restaurant/{name}",[RestaurantController::class,"show"]);
Route::post("restaurants/cuisine",[RestaurantController::class,"showByCuisineType"]);
Route::post("restaurants/address",[RestaurantController::class,"showByAddress"]);
Route::post("restaurants/address/cuisine",[RestaurantController::class,"showByAddressAndCuisinType"]);

Route::group(["middleware" => ["auth:sanctum"]],function (){
    Route::get("logout",[UserController::class,"logout"]);
    Route::get("my/orders",[OrderController::class,"userOrders"]);
    Route::post("place/order",[OrderController::class,"store"]);
    });