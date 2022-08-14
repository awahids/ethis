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

// topic routes
Route::post('/topic', [TopicController::class, 'store']);
Route::get('/topics', [TopicController::class, 'index']);
Route::get('/topic/{id}', [TopicController::class, 'show']);
Route::put('/topic/{id}', [TopicController::class, 'update']);
Route::delete('/topic/{id}', [TopicController::class, 'destroy']);

// tag routes
Route::post('/tag', [TagController::class, 'store']);
