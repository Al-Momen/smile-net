<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\FrontEnd\HomeController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Frontend\UserAuthController;


//To clear all cache
Route::get('cc', function () {
    Artisan::call('optimize:clear');
    return "Cleared!";
});

Route::namespace('FrontEnd')->name('user.')->group(function(){
    Route::get('/',[HomeController::class,'index'])->name('index');
    Route::get('/pricing',[HomeController::class,'pricing'])->name('pricing');
});


// Route::group(['namespace' => 'Frontend'], function () {


//     Route::group(['namespace' => 'Web'], function () {

//     });

// });

// Admin Login & Logout
Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('login', [AdminAuthController::class,'getLogin'])->name('login-form');
    Route::post('login', [AdminAuthController::class,'postLogin'])->name('login');
    Route::get('logout', [AdminAuthController::class,'getLogout'])->name('logout');
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



Route::name('user.')->as('user.')->group(function(){
    Route::post('/login', [UserAuthController::class, 'userLogin'])->name('login');
    require_once __DIR__ . '/users/user.php';
});





