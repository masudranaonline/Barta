<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
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



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/', [HomeController::class, 'index']);

    Route::get('/{username}/posts', [HomeController::class, 'timeline']);

    Route::get('/post', [PostController::class, 'index']);
    Route::post('/create', [PostController::class, 'store']);
    Route::get('/edit/{id}', [PostController::class, 'edit']);
    Route::post('/update/{uuid}', [PostController::class, 'update']);
    Route::post('/post/destroy/{uuid}', [PostController::class, 'destroy']);

    //comments

    Route::get('/comments/{uuid}', [CommentsController::class, 'index']);


});

require __DIR__.'/auth.php';
