<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\VisitorController;
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

Route::get('/{vue_capture?}', function () {  
    return view('app');  
})->where('vue_capture','[\/\w\.-]*');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/check-login', [LoginController::class, 'checkLogin']);
Route::post('/logout', [LogoutController::class, 'logout']);


Route::post('/post/data', [PostController::class, 'post']);
Route::post('/comment/store', [CommentController::class, 'store']);
Route::post('/visitor/onload', [VisitorController::class, 'onload']);

