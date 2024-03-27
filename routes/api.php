<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::post('/logout', [App\Http\Controllers\API\AuthCOntroller::class, 'logout']);
    Route::post('/updatePassword', [App\Http\Controllers\API\AuthCOntroller::class, 'updatePassword']);
    Route::post('/storeProfile', [App\Http\Controllers\API\AuthCOntroller::class, 'storeProfile']);

});

    //Route Admin
Route::group(['middelware' => ['auth:sanctum', 'admin']], function(){
    //Route Category
    Route::post('/category/create', [App\Http\Controllers\API\CategoryController::class, 'store']);
    Route::post('/category/update/{id}', [App\Http\Controllers\API\CategoryController::class, 'update']);
    Route::delete('category/destroy/{id}', [App\Http\Controllers\API\CategoryController::class, 'destroy']);

    //route News
    Route::post('/news/create', [App\Http\Controllers\API\NewsController::class, 'store']);
    Route::delete('/news/destory/{id}', [App\Http\Controllers\API\NewsController::class, 'destroy']);
    Route::post('/news/update/{id}', [App\Http\Controllers\API\NewsController::class, 'update']);
});


Route::post('/login', [App\Http\Controllers\API\AuthCOntroller::class, 'login']);
Route::post('/register', [App\Http\Controllers\API\AuthCOntroller::class, 'register']);
Route::get('/allUsers', [App\Http\Controllers\API\AuthCOntroller::class, 'allUsers']);

//get data news
Route::get('/allNews', [App\Http\Controllers\API\NewsController::class, 'index']);
//get data news by id
Route::get('/news/{id}', [App\Http\Controllers\API\NewsController::class, 'show']);

Route::get('/allCategory', [App\Http\Controllers\API\CategoryController::class, 'index']);
Route::get('/category/{id}', [App\Http\Controllers\API\CategoryController::class, 'show']);
Route::get('/carousel', [App\Http\Controllers\API\FrontEndController::class, 'index']);


