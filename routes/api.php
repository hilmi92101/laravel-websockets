<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CommentController;

use App\Http\Controllers\Api\Visitor\LoginController as VisitorLoginController;

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

Route::prefix('visitor')->middleware('auth:sanctum')->group(function() {
});




Route::get('/posts/{post}/comments', [CommentController::class, 'index']);


Route::middleware('auth:api')->group(function() {

    Route::get('/posts/{post}/comment', [CommentController::class, 'store']);
    
});

Broadcast::routes(['middleware' => ['auth:sanctum']]);




// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
