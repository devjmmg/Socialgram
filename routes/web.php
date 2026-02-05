<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;

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

//Método tipo clousure
// Route::get('/', function () {
//     return view('principal');
// });

//HomeController
//Route::get('/',[HomeController::class,'index'])->name('home.index');

//Si solo vamos a tener una función en un controlador podemos hacer uso del constructor invoke
Route::get('/', HomeController::class)->name('home.index');

Route::get('/register', [RegisterController::class,'index'])->name('register.index');
Route::post('/register', [RegisterController::class,'store'])->name('register.store');

Route::get('/login', [LoginController::class,'index'])->name('login.index');
Route::post('/login', [LoginController::class,'store'])->name('login.store');

Route::post('/logout',[LogoutController::class,'store'])->name('logout.store');

Route::get('/{user:username}',[PostController::class,'index'])->name('posts.index');
Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');
Route::post('/posts',[PostController::class,'store'])->name('posts.store');
Route::get('{user:username}/posts/{post}',[PostController::class,'show'])->name('posts.show');
Route::delete('posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');

//Comentarios
Route::post('{user:username}/posts/{post}',[CommentController::class,'store'])->name('comments.store');

//Me gusta a las fotos
Route::post('/posts/{post}/likes',[LikeController::class,'store'])->name('posts.like.store');
Route::delete('/posts/{post}/likes',[LikeController::class,'destroy'])->name('posts.like.destroy');

//Subir imagen
Route::post('/images',[ImageController::class,'store'])->name('images.store');

//Editar perfil
Route::get('/{user:username}/edit',[ProfileController::class,'edit'])->name('profile.edit');
Route::post('/{user:username}/edit',[ProfileController::class,'update'])->name('profile.update');

//Actualizar contraseña
Route::post('/{user:username}/reset-password',[PasswordResetController::class,'update'])->name('password.update');

//Siguiendo usuarios
Route::post('/{user:username}/follow',[FollowerController::class,'store'])->name('follow.store');
Route::delete('/{user:username}/unfollow',[FollowerController::class,'destroy'])->name('follow.destroy');

//Buscar amigos
Route::get('/friends/{username}',[FriendController::class,'index'])->name('friends.index');