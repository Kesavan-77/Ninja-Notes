<?php

use App\Http\Controllers\LikeController;
use App\Http\Controllers\MarkdownController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TrashController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin/dashboard', function () {
    return view('admin.adminPages.dashboard');
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

Route::get('/notification',[NotificationController::class,'notify'])->name('notify');

Route::resource('/notes',NoteController::class)->middleware((['auth','verified']));

Route::get('trash',[TrashController::class,'index'])->name('trash.index');
Route::post('trash/{id}/restore',[TrashController::class,'restore'])->name('trash.restore');
Route::delete('trash/{id}',[TrashController::class,'destroy'])->name('trash.destroy');

Route::post('/likes',[LikeController::class,'manage'])->name('likes.manage');
Route::get('/likes',[LikeController::class,'count'])->name('likes.count');

Route::resource('notes/markdown',MarkdownController::class);

Route::post('/search-note',[SearchController::class,'searchNote'])->name('search-note');

require __DIR__.'/auth.php';


require __DIR__.'/adminauth.php';
