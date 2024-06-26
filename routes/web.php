<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\DiscoverController;
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

Route::get('/', [DrinkController::class, 'home']);
Route::get('posts/{post}', [PostController::class, 'show']);


Route::controller(PostController::class)->middleware(['auth'])->group(function(){
    Route::get('/drinks/create', 'create');
    Route::post('/drinks', 'store');
    Route::get('posts/{post}/edit', 'edit');
    Route::put('posts/{post}', 'update');
    Route::delete('posts/{post}', 'delete');
});
Route::get('/drinks/{drink}', [DrinkController:: class, 'index']);
Route::post('/discover/{postId}',[DiscoverController::class,'storeDiscovery']);
Route::post('/notDiscover/{postId}',[DiscoverController::class,'destroyDiscovery']);
Route::get('/drink/{drink}/prefecture/{prefecture}',[DrinkController::class,'serchPref']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
