<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PostController::class, 'home']); 
Route::get('/drinks/create', [PostController::class, 'create']);
Route::get('/drinks/{drink}', [PostController::class, 'index']);
Route::post('/drinks', [PostController::class, 'store']);
Route::get('posts/{post}', [PostController::class, 'show']);
Route::get('posts/{post}/edit', [PostController::class, 'edit']);
Route::put('posts/{post}', [PostController::class, 'update']);
Route::delete('posts/{post}', [PostController::class, 'delete']);



