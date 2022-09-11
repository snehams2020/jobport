<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/register-employer', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register-employer');

Route::get('create',  [App\Http\Controllers\JobController::class, 'create'])->name('create');
Route::get('edit/{id}',  [App\Http\Controllers\JobController::class, 'edit'])->name('edit');
Route::get('view/{id}',  [App\Http\Controllers\JobController::class, 'ViewJob'])->name('view');

Route::get('create-job',  [App\Http\Controllers\JobController::class, 'createJob'])->name('create-job');
Route::post('add-job',  [App\Http\Controllers\JobController::class, 'addJob'])->name('add-job');
Route::post('edit-job',  [App\Http\Controllers\JobController::class, 'editJob'])->name('edit-job');
Route::get('delete-job/{id}',  [App\Http\Controllers\JobController::class, 'deleteJob'])->name('delete-job');

Route::get('index',  [App\Http\Controllers\JobController::class, 'index']);
Route::get('/mobile-login', [App\Http\Controllers\Auth\RegisterController::class, 'loginMobileForm'])->name('mobile-login');
Route::post('/send-otp', [App\Http\Controllers\Auth\LoginController::class, 'sendOtp'])->name('send-otp');
Route::post('/submit-otp', [App\Http\Controllers\Auth\LoginController::class, 'submitOtp'])->name('submit-otp');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
