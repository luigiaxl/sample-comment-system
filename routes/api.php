<?php

use App\Http\Controllers\CommentController;
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

Route::prefix('comments')->group(function () {
    Route::get('/', [CommentController::class, 'index'])->name('comments.fetch');
    Route::post('/', [CommentController::class, 'store'])->name('comments.store');

    Route::get('{comment}/replies', [CommentController::class, 'replies'])->name('reply.fetch');
    Route::post('{comment}/reply', [CommentController::class, 'reply'])->name('reply.store');
});