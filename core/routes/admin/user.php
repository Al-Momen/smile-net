<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ManageUsersController;

Route::group(['prefix'=>'users'], function(){
    Route::get('list', [ManageUsersController::class, 'allUsers'])->name('users.all');
    Route::get('active',  [ManageUsersController::class, 'activeUsers'])->name('users.active');
    Route::get('banned',  [ManageUsersController::class, 'bannedUsers'])->name('users.banned');
    Route::get('email-verified', [ManageUsersController::class, 'emailVerifiedUsers'])->name('users.email.verified');
    Route::get('email-unverified',  [ManageUsersController::class, 'emailUnverifiedUsers'])->name('users.email.unverified');
    Route::get('sms-unverified',  [ManageUsersController::class, 'smsUnverifiedUsers'])->name('users.sms.unverified');
    Route::get('sms-verified',  [ManageUsersController::class, 'smsVerifiedUsers'])->name('users.sms.verified');
    Route::get('kyc-verified',  [ManageUsersController::class, 'kycVerifiedUsers'])->name('users.kyc.verified');
    Route::get('kyc-unverified',  [ManageUsersController::class, 'kycUnVerifiedUsers'])->name('users.kyc.unverified');
    Route::get('with-balance',  [ManageUsersController::class, 'usersWithBalance'])->name('users.with.balance');

    Route::get('{scope}/search', [ManageUsersController::class, 'search'])->name('users.search');
    Route::get('user/detail/{id}', [ManageUsersController::class, 'detail'])->name('users.detail');
    Route::post('update/{id}',  [ManageUsersController::class, 'update'])->name('users.update');
    Route::post('add-sub-balance/{id}',  [ManageUsersController::class, 'addSubBalance'])->name('users.add.sub.balance');
    Route::get('send-email/{id}',  [ManageUsersController::class, 'showEmailSingleForm'])->name('users.email.single');
    Route::post('send-email/{id}',  [ManageUsersController::class, 'sendEmailSingle'])->name('users.email.single');

    Route::get('send-email', [ManageUsersController::class,'showEmailAllForm'])->name('users.email.all');
    Route::post('send-email', [ManageUsersController::class,'sendEmailAll'])->name('users.email.send');
});

