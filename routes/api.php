<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\AuthenticationController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\PermissionController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\UserController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(["prefix"=>"v1"],function(){
    Route::post('/store',[PostController::class,"store"]);
});

Route::group(['prefix'=>'v1'],function(){
    Route::post("/login",[AuthenticationController::class,'login']);
});

Route::group(['prefix'=>'v1','middleware'=>['auth:sanctum']],function(){
    Route::get("/me",[UserController::class,'loggedInfo']);
    Route::get("/users",[UserController::class,'userList'])->middleware('permission:user.view');
    Route::post("/users",[UserController::class,'createUser'])->middleware('permission:user.create');;
});



Route::group(['prefix'=>'v1'],function(){
    Route::get("/categories",[CategoryController::class,'index']);
    Route::post("/categories",[CategoryController::class,'create']);
    Route::get("/categories/{id}",[CategoryController::class,'find']);
    Route::put("/categories/{id}",[CategoryController::class,'update']);
    Route::delete("/categories/{id}",[CategoryController::class,'destroy']);
    Route::get("/permissions",[PermissionController::class,'index']);
    Route::post("/permissions",[PermissionController::class,'create']);
    Route::apiResource('roles', RoleController::class);

});
