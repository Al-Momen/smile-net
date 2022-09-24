<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Frontend\BookController;
use App\Http\Controllers\Frontend\NewsController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\TicketController;
use App\Http\Controllers\Frontend\UsersAuthController;
use App\Http\Controllers\Frontend\UsersDeshboardController;

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

//To clear all cache
Route::get('cc', function () {
    Artisan::call('optimize:clear');
    return "Cleared!";
});


// Admin Login & Logout
Route::get('admin', [AdminAuthController::class, 'getLoginForm'])->name('login.form');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'getLogin'])->name('login-form');
    Route::post('login', [AdminAuthController::class, 'postLogin'])->name('login');
    Route::get('logout', [AdminAuthController::class, 'getLogout'])->name('logout');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    require_once __DIR__ . '/admin/acl.php';
    require_once __DIR__ . '/admin/user.php';
    require_once __DIR__ . '/admin/email.php';
    require_once __DIR__ . '/admin/settings.php';
    require_once __DIR__ . '/admin/sms.php';
    require_once __DIR__ . '/admin/gateways.php';
    require_once __DIR__ . '/admin/extra.php';
});



// Users all route
Route::namespace('Frontend')->group(function () {
    // user page route
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('pricing', [HomeController::class, 'pricing'])->name('pricing');
    Route::get('voting', [HomeController::class, 'voting'])->name('voting');
    Route::get('magazine', [HomeController::class, 'magazine'])->name('magazine');
    Route::get('live/now', [HomeController::class, 'live_now'])->name('live_now');
    Route::get('music', [HomeController::class, 'music'])->name('music');
    Route::get('smile/tv', [HomeController::class, 'smile_tv'])->name('smile_tv');
    Route::get('news', [HomeController::class, 'news'])->name('news');
    Route::get('news-details', [HomeController::class, 'newsDetails'])->name('news_details');
    Route::get('smile-tv', [HomeController::class, 'smileTv'])->name('smile_tv');
    Route::get('magazine-details', [HomeController::class, 'magazineDetails'])->name('magazine_details');

    // Email verify by OTP
    Route::get('otp', [UsersAuthController::class, 'userOtpForm'])->name('otp.form');
    Route::post('otp', [UsersAuthController::class, 'userOtp'])->name('otp');

    // user login route
    Route::match(['get', 'post'], 'registration', [UsersAuthController::class, 'userRegistrationForm'])->name('registration');
    Route::get('login', [UsersAuthController::class, 'userLoginForm'])->name('login');
    Route::post('login/action', [UsersAuthController::class, 'loginAction'])->name('login.action');
    Route::get('logout', [UsersAuthController::class, 'logout'])->name('logout');

    //user deshboard route
    Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => 'general_user'], function () {
        Route::get('deshboard', [UsersDeshboardController::class, 'index'])->name('deshboard');
        Route::get('profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('ticket', [UsersDeshboardController::class, 'ticket'])->name('ticket');
        Route::get('book', [UsersDeshboardController::class, 'book'])->name('book');
        Route::get('news', [UsersDeshboardController::class, 'news'])->name('news');
        Route::post('store/news', [NewsController::class, 'storeNews'])->name('store.news');
        Route::get('destroy/news/{id}', [NewsController::class, 'destroy'])->name('destroy.news');
        Route::post('store/tickets', [TicketController::class, 'storeTickets'])->name('store.tickets');
        Route::get('destroy/tickets/{id}', [TicketController::class, 'destroy'])->name('destroy.tickets');
        Route::post('store/books', [BookController::class, 'storeBooks'])->name('store.books');
        Route::get('destroy/books/{id}', [BookController::class, 'destroy'])->name('destroy.books');
    });

    // if login then access pages
    Route::group(['middleware' => 'general_user'], function () {
        Route::get('place_order', [UsersDeshboardController::class, 'placeOrder'])->name('place_order');
        Route::get('vote-details', [UsersDeshboardController::class, 'voteDetails'])->name('vote_details');
    });
});
