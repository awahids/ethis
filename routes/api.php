<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\TopicController;
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
// news router
Route::post('/news', [NewsController::class, 'store']);
Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/{id}', [NewsController::class, 'show']);
Route::put('/news/{id}', [NewsController::class, 'update']);
Route::delete('/news/{id}', [NewsController::class, 'destroy']);

// topic routes
Route::post('/topic', [TopicController::class, 'store']);
Route::get('/topics', [TopicController::class, 'index']);
Route::get('/topic/{id}', [TopicController::class, 'show']);
Route::put('/topic/{id}', [TopicController::class, 'update']);
Route::delete('/topic/{id}', [TopicController::class, 'destroy']);

// tag routes
Route::post('/tag', [TagController::class, 'store']);
Route::get('/tags', [TagController::class, 'index']);
Route::get('/tag/{id}', [TagController::class, 'show']);
Route::put('/tag/{id}', [TagController::class, 'update']);
Route::delete('/tag/{id}', [TagController::class, 'destroy']);
