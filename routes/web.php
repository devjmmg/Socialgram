<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function() {
    Route::get('/login', [AuthController::class,'login'])->name('login');
    Route::post('/login', [AuthController::class,'authenticate'])->name('login.authenticate');

    Route::get('/register', [AuthController::class,'register'])->name('register');
    Route::post('/register', [AuthController::class,'store'])->name('register.store');
});

Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [AuthController::class,'logout'])->name('logout');

    Route::get('/', HomeController::class)->name('home.index');

    // Buscar amigos
    Route::get('/friends', [FriendController::class,'index'])->name('friends.index');

    // Seguidores
    Route::get('/followers', [FollowerController::class, 'index'])->name('followers.index');

    // Posts
    Route::get('/posts/create', [PostController::class,'create'])->name('posts.create');
    Route::post('/posts', [PostController::class,'store'])->name('posts.store');
    Route::delete('/posts/{post}', [PostController::class,'destroy'])->name('posts.destroy');
});

// Posts públicos
Route::get('/{user:username}', [PostController::class,'index'])->name('posts.index');
Route::get('/{user:username}/posts/{post}', [PostController::class,'show'])->name('posts.show');

//Comentarios
Route::post('{user:username}/posts/{post}', [CommentController::class,'store'])->name('comments.store');

//Me gusta a las fotos
Route::post('/posts/{post}/likes', [LikeController::class,'store'])->name('posts.like.store');
Route::delete('/posts/{post}/likes', [LikeController::class,'destroy'])->name('posts.like.destroy');

//Editar perfil
Route::get('/{user:username}/edit', [ProfileController::class,'edit'])->name('profile.edit');
Route::post('/{user:username}/edit', [ProfileController::class,'update'])->name('profile.update');

//Actualizar contraseña
Route::post('/{user:username}/reset-password', [PasswordResetController::class,'update'])->name('password.update');