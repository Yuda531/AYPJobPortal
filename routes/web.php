<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('home', ["title" => 'Home']);
});

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerAction')->name('register.action');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        $user = auth()->user();
        $jobSeeker = $user->jobSeeker;
        return view('dashboard', compact('user', 'jobSeeker'));
    })->name('dashboard');

    Route::get('dashboard', [App\Http\Controllers\PostsController::class, 'index'])->name('dashboard');
    Route::post('posts', [App\Http\Controllers\PostsController::class, 'store'])->name('posts.store');
    Route::delete('posts/{post}', [App\Http\Controllers\PostsController::class, 'destroy'])->name('posts.destroy');
    Route::put('posts/{post}', [App\Http\Controllers\PostsController::class, 'update'])->name('posts.update');

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
