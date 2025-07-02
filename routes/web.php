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
    Route::get('posts/{post}', [App\Http\Controllers\PostsController::class, 'show'])->name('posts.show');

    Route::post('posts/{post}/comments', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
    Route::delete('comments/{comment}', [App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/{user}', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::get('/jobs', [App\Http\Controllers\JobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/create', [App\Http\Controllers\JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [App\Http\Controllers\JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{job}', [App\Http\Controllers\JobController::class, 'show'])->name('jobs.show');
    Route::get('/jobs/{job}/edit', [App\Http\Controllers\JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{job}', [App\Http\Controllers\JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{job}', [App\Http\Controllers\JobController::class, 'destroy'])->name('jobs.destroy');
    Route::post('/jobs/{job}/apply', [App\Http\Controllers\JobController::class, 'apply'])->name('jobs.apply');
    Route::get('/employer/jobs/{job}/applications', [App\Http\Controllers\JobController::class, 'applicants'])->name('jobs.applicants');
    Route::get('/employer/applications/{application}', [App\Http\Controllers\JobController::class, 'applicantDetail'])->name('jobs.applicant_detail');
    Route::get('/employer/jobs/{job}/export-applicants-excel', [App\Http\Controllers\JobController::class, 'exportApplicantsExcel'])->name('jobs.export_applicants_excel');

    Route::get('/network', [App\Http\Controllers\NetworkController::class, 'index'])->name('network.index');
});
