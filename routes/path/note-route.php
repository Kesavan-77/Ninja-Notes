<?php

use App\Http\Controllers\AdminAuth\DashboardController;
use App\Http\Controllers\Notes\LikeController;
use App\Http\Controllers\Notes\MarkdownController;
use App\Http\Controllers\Notes\NoteController;
use App\Http\Controllers\Notes\NotificationController;
use App\Http\Controllers\Notes\SearchController;
use App\Http\Controllers\Notes\TrashController;
use Illuminate\Support\Facades\Route;


Route::get('/notification', [NotificationController::class, 'notify'])->name('notify');
Route::post('/search-note', [SearchController::class, 'searchNote'])->name('search-note');

Route::resource('/notes', NoteController::class);

// Likes
Route::post('/likes', [LikeController::class, 'manage'])->name('likes.manage');
Route::get('/likes', [LikeController::class, 'count'])->name('likes.count');

// Trash
Route::prefix('trash')->group(function () {
    Route::get('/', [TrashController::class, 'index'])->name('trash.index');
    Route::post('{id}/restore', [TrashController::class, 'restore'])->name('trash.restore');
    Route::delete('{id}', [TrashController::class, 'destroy'])->name('trash.destroy');
});

// Markdown
Route::resource('notes/markdown', MarkdownController::class);


