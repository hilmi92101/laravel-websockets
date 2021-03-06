<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CommentController;

use App\Http\Controllers\Api\Visitor\LoginController as VisitorLoginController;
use App\Http\Controllers\Api\Author\LoginController as AuthorLoginController;

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



Route::prefix('visitor')->group(function() {
    Route::post('/login', [VisitorLoginController::class, 'login']);
    
});

Route::prefix('author')->group(function() {
    Route::post('/login', [AuthorLoginController::class, 'login']);
    
});

Route::get('/posts/{post}/comments', [CommentController::class, 'index']);


Route::middleware('auth:api')->group(function() {

    Route::get('/posts/{post}/comment', [CommentController::class, 'store']);
    
});

Broadcast::routes(['middleware' => ['auth:sanctum']]);




Route::middleware('auth:sanctum')->post('/user', function (Request $request) {
    return $request->user();
});
