<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SmsTemplateController;


Route::group(['prefix' => 'sms-template', 'as' => 'sms.templates.'], function () {
    Route::get('global', [SmsTemplateController::class,'smsTemplate'])->name('home');
    Route::post('global', [SmsTemplateController::class,'smsTemplateUpdate'])->name('global');
    Route::get('setting',[SmsTemplateController::class,'smsSetting'])->name('templates.setting');
    Route::post('setting', [SmsTemplateController::class,'smsSettingUpdate'])->name('setting');
    Route::get('index', [SmsTemplateController::class,'index'])->name('index');
    Route::get('edit/{id}', [SmsTemplateController::class,'edit'])->name('edit');
    Route::post('update/{id}', [SmsTemplateController::class,'update'])->name('update');
    Route::post('send/test/sms', [SmsTemplateController::class,'sendTestSMS'])->name('send.test.sms');
});
