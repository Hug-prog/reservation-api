<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\TypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// *****************************************************
// ***************public routes********************
// *****************************************************

// ***************Auth**********************
Route::post("/register", [\App\Http\Controllers\AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);

//


Route::group(["middleware" => ["auth:sanctum"]], function () {
    // ***************Type**********************
    Route::post("/type",[TypeController::class,"create"]);
    Route::get("/types",[TypeController::class,"index"]);
    Route::get("/type/{id}",[TypeController::class,"show"]);
    Route::delete("/type/{id}",[TypeController::class,"destroy"]);

    // ***************place**********************
    Route::post("/place",[PlaceController::class,"create"]);
    Route::get("/places",[PlaceController::class,"index"]);
    Route::get("/place/{id}",[PlaceController::class,"show"]);
    Route::delete("/place/{id}",[PlaceController::class,"destroy"]);

    // ***************event**********************
    Route::post("/event",[EventController::class,"create"]);
    Route::get("/events",[EventController::class,"index"]);
    Route::get("/event/{id}",[EventController::class,"show"]);
    Route::delete("/event/{id}",[EventController::class,"destroy"]);


});
