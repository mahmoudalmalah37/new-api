<?php

use App\Http\Controllers\AuthControlIIIer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//public routes
Route::post('/login', [AuthControlIIIer::class, 'login']);
Route::get('/posts', [postController::class, 'index']);
Route::get('/posts/{id}', [postController::class, 'show']);
Route::get('/posts/search/{name}', [postController::class, 'search']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/register', [AuthControlIIIer::class, 'register']);
    Route::post('/posts', [postController::class, 'store']);
    Route::put('/posts/{id}', [postController::class, 'update']);
    Route::delete('/posts/{id}', [postController::class, 'destroy']);
    Route::post('/logout', [AuthControlIIIer::class, 'logout']);
});