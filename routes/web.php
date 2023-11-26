<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    Route::get('/{username}/edit', [ProfileController::class, 'edit'])->name('profile.edit');



    Route::post('/{username}/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/', [HomeController::class, 'index']);


    Route::post('/profile/{username}/image', [UserController::class, 'store']);

    Route::get('/{username}/profile', [UserController::class, 'posts']);
    Route::get('/{username}/posts/{postId}', [UserController::class, 'post'])->name('user.post');
    Route::get('/{username}/about', [UserController::class, 'about']);
    Route::get('/{username}/photos', [UserController::class, 'photos']);
    Route::get('/{username}/videos', [UserController::class, 'videos']);
    Route::get('/{username}/friends', [UserController::class, 'friends']);
    Route::get('/{username}/followers', [UserController::class, 'followers']);
    Route::get('/{username}/groups', [UserController::class, 'groups']);

    // post relationship
    Route::post('/post/{username}/new', [PostController::class, 'store']);

    Route::get('/post', [PostController::class, 'index']);
    Route::post('/create', [PostController::class, 'store']);
    Route::get('/edit/{id}', [PostController::class, 'edit']);
    Route::post('/update/{uuid}', [PostController::class, 'update']);
    Route::post('/post/destroy/{uuid}', [PostController::class, 'destroy']);

    //comments

    Route::post('/post/comment/{postId}', [CommentsController::class, 'store']);


});

require __DIR__.'/auth.php';
