<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NewsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// //handel redirect register to login
// Route::match(['get', 'post'], '/register', function(){ return redirect('/login');});




//route middleware
Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', [App\Http\Controllers\Profile\ProfileController::class, 'index'])->name('profile.index');

    //route for admin
    Route::middleware(['auth', 'admin'])->group(function () {
        //Route for News using Resource
        Route::resource('news', NewsController::class);
        //route for Category using Resource
        Route::resource('category', CategoryController::class)->except('show');
    });
});
