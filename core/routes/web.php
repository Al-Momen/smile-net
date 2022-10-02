<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Frontend\BookController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsController;
use App\Http\Controllers\Frontend\EventController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\UsersAuthController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\Frontend\UsersDeshboardController;
use Doctrine\DBAL\Driver\Middleware;

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
    Route::get('events', [HomeController::class, 'event'])->name('event');
    // navbar events list 
    Route::get('user/event/{name}', [HomeController::class, 'eventList'])->name('user.event');

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
        // event all route
        Route::get('events', [EventController::class, 'events'])->name('events');
        Route::post('store/events', [EventController::class, 'storeEvents'])->name('store.events');
        Route::get('edit/events/{id}', [EventController::class, 'editEvents'])->name('edit.events');
        Route::post('update/events/{id}', [EventController::class, 'updateEvents'])->name('update.events');
        Route::get('destroy/events/{id}', [EventController::class, 'destroy'])->name('destroy.events');
        // book all route
        Route::get('book', [BookController::class, 'books'])->name('books');
        Route::post('store/books', [BookController::class, 'storeBooks'])->name('store.books');
        Route::get('edit/books/{id}', [BookController::class, 'editBooks'])->name('edit.books');
        Route::post('update/books/{id}', [BookController::class, 'updateBooks'])->name('update.books');
        Route::get('destroy/books/{id}', [BookController::class, 'destroy'])->name('destroy.books');
        // news all route
        Route::get('news', [NewsController::class, 'news'])->name('news');
        Route::post('store/news', [NewsController::class, 'storeNews'])->name('store.news');
        Route::get('edit/news/{id}', [NewsController::class, 'editNews'])->name('edit.news');
        Route::post('update/news/{id}', [NewsController::class, 'updateNews'])->name('update.news');
        Route::get('destroy/news/{id}', [NewsController::class, 'destroy'])->name('destroy.news');
    });

    // if login then access pages
    Route::group(['middleware' => 'general_user'], function () {
        Route::get('place_order', [UsersDeshboardController::class, 'placeOrder'])->name('place_order');
        Route::get('vote-details', [UsersDeshboardController::class, 'voteDetails'])->name('vote_details');
    });
});


Route::namespace('Admin')->group(function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.','middleware'=>'auth'], function () {
        // admin category controller
        Route::get('category', [AdminCategoryController::class, 'index'])->name('category.index');
        Route::post('category/store', [AdminCategoryController::class, 'storeCategory'])->name('category.store');
        Route::get('category/edit/{id}', [AdminCategoryController::class, 'editCategory'])->name('category.edit');
        Route::post('category/update/{id}', [AdminCategoryController::class, 'updateCategory'])->name('category.update');
        Route::get('category/destroy/{id}', [AdminCategoryController::class, 'destroy'])->name('category.destroy');


        // admin access events
        Route::get('event', [AdminEventController::class, 'index'])->name('event.index');
        Route::get('event/view/{id}', [AdminEventController::class, 'editEvent'])->name('event.view');
        Route::post('event/edit/{id}', [AdminEventController::class, 'editStatusEvent'])->name('status.edit');
        Route::get('event/destroy/{id}', [AdminEventController::class, 'destroy'])->name('event.destroy');
    });
});
