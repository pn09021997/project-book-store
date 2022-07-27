<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
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
//
//Route::get('/kkk',function (Request $request){
//
//    $userr = new  \App\Models\User();
//    $userr->id = "1234";
////    $userr->name = "kasd";
////    dd($userr->tokens()->count());
////    dd($userr->currentAccessToken());
//    $token = $userr->createToken("123456");
//
//    return ['token' => $token->plainTextToken];
//});

Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login'])->name('login');

Route::prefix('/category')->middleware(['auth:sanctum','admin'])->group(function (){
    Route::get('/{id}',[\App\Http\Controllers\CategoriesController::class,'category_get']);
    Route::post('/create',[\App\Http\Controllers\CategoriesController::class,'categories_create']);
    Route::get('/delete/{id}',[\App\Http\Controllers\CategoriesController::class,'categories_delete']);
    Route::post('/update/{id}',[\App\Http\Controllers\CategoriesController::class,'categories_update']);
});

Route::middleware('auth:sanctum')->group(function (){
    Route::get('logout',[UserController::class,'logout']);
});




