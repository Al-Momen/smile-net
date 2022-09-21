<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UsersAuthController;
use App\Http\Controllers\Frontend\UsersDeshboardController;


// user page route
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/pricing', [HomeController::class, 'pricing'])->name('pricing');
Route::get('/voting', [HomeController::class, 'voting'])->name('voting');
Route::get('/magazine', [HomeController::class, 'magazine'])->name('magazine');
Route::get('/live_now', [HomeController::class, 'live_now'])->name('live_now');
Route::get('/music', [HomeController::class, 'music'])->name('music');
Route::get('/smile_tv', [HomeController::class, 'smile_tv'])->name('smile_tv');
Route::get('/news', [HomeController::class, 'news'])->name('news');
Route::get('/deshboard/place_order', [HomeController::class, 'placeOrder'])->name('deshboard.place_order')->middleware('general_user');


// user login route
Route::get('/regstration', [UsersAuthController::class, 'userRegstrationForm'])->name('regstration.form');
Route::get('/login', [UsersAuthController::class, 'userLoginForm'])->name('login.form');
// Route::post('/regstration', [UserAuthController::class, 'userRegstration'])->name('regstration');
// Route::post('/login', [UserAuthController::class, 'userLogin'])->name('login');
// Route::get('/logout', [UsersAuthController::class, 'userLogout'])->name('logout');


Route::get('/deshboard', [UsersDeshboardController::class, 'index'])->name('deshboard');
Route::get('/deshboard/ticket', [UsersDeshboardController::class, 'ticket'])->name('deshboard.ticket');
Route::get('/deshboard/book', [UsersDeshboardController::class, 'book'])->name('deshboard.book');
Route::get('/deshboard/news', [UsersDeshboardController::class, 'news'])->name('deshboard.news');


// Email verify by OTP
Route::get('/otp', [UsersAuthController::class, 'userOtpForm'])->name('otp.form');
// Route::post('/otp', [UserAuthController::class, 'userOtp'])->name('otp');
