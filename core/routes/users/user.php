<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserAuthController;
use App\Http\Controllers\Frontend\UserDashboardController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Mail;


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
Route::get('/regstration/form', [UserAuthController::class, 'userRegstrationForm'])->name('regstration.form');
Route::get('/login', [UserAuthController::class, 'userLoginForm'])->name('login.form');
Route::post('/regstration', [UserAuthController::class, 'userRegstration'])->name('regstration');
Route::post('/login', [UserAuthController::class, 'userLogin'])->name('login');
Route::get('/logout', [UserAuthController::class, 'userLogout'])->name('logout');


// user deshboard route
Route::middleware('general_user')->group(function(){
    Route::get('/deshboard', [UserDashboardController::class, 'index'])->name('deshboard');
    Route::get('/deshboard/ticket', [UserDashboardController::class, 'ticket'])->name('deshboard.ticket');
    Route::get('/deshboard/book', [UserDashboardController::class, 'book'])->name('deshboard.book');
    Route::get('/deshboard/news', [UserDashboardController::class, 'news'])->name('deshboard.news');
    
});


// Email verify by OTP
Route::get('/otp', [UserAuthController::class, 'userOtpForm'])->name('otp.form');
Route::post('/otp', [UserAuthController::class, 'userOtp'])->name('otp');
