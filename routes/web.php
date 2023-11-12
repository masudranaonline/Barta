<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;

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

Route::get('/index', function () {
    return view('index');
});


Route::get('/', [AuthController::class, 'loginView'])->name('login.create');
Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::get('/register', [AuthController::class, 'registerView'])->name('register.create');
Route::post('/register', [AuthController::class, 'register'])->name('user.register');

Route::post('/logout', [AuthController::class, 'logout']);

// Route::get('/dashboard', function(){
//     return view('dashboard');
// })->middleware('auth');

Route::get('/home', [HomeController::class, 'index'])->middleware('auth');


Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->middleware('auth');
Route::post('/profile/update', [ProfileController::class, 'update'])->middleware('auth');


Route::get('/post', [PostController::class, 'index']);
Route::post('/create', [PostController::class, 'store']);
Route::get('/edit/{id}', [PostController::class, 'edit']);
Route::post('/update/{uuid}', [PostController::class, 'update']);
Route::post('/post/destroy/{uuid}', [PostController::class, 'destroy']);
