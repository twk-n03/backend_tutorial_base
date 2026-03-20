<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\CommentController;


Route::post('articles/{articleId}/comments', [CommentController::class, 'store']);
Route::get('articles/{articleId}/comments', [CommentController::class, 'index']);
Route::delete('articles/{articleId}/comments/{commentId}', [CommentController::class, 'destroy']);
Route::put('articles/{articleId}/comments/{commentId}', [CommentController::class, 'update']);