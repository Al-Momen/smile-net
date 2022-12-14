<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\KycController;
use App\Http\Controllers\Admin\ExtensionController;
use App\Http\Controllers\Admin\GeneralSettingController;

Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {
    Route::get('index', [GeneralSettingController::class, 'index'])->name('index');
    Route::post('update', [GeneralSettingController::class, 'update'])->name('update');
    Route::get('optimize', [GeneralSettingController::class, 'optimize'])->name('optimize');
    Route::get('logo-icon', [GeneralSettingController::class, 'logoIcon'])->name('logo.icon');
    Route::post('logo-icon', [GeneralSettingController::class, 'logoIconUpdate'])->name('logo.icon.update');
    Route::get('seo/manage', 'GeneralSettingController@seoPage')->name('seo.page');
    Route::post('seo/update/{key}', [GeneralSettingController::class, 'seoUpdate'])->name('seo.update');
    


    Route::group(['prefix' => 'extensions', 'as' => 'extensions.'], function () {
        Route::get('list', 'ExtensionController@index')->name('index');
        Route::post('update/{id}', 'ExtensionController@update')->name('update');
        Route::post('status/change', 'ExtensionController@statusChange')->name('status');
    });
});

Route::group(['prefix' => 'kyc', 'as' => 'kyc.'], function () {
    Route::get('manage', [KycController::class, 'manageKyc'])->name('manage');
    Route::get('edit', [KycController::class, 'editKyc'])->name('edit');
    Route::post('update',  [KycController::class, 'updateKyc'])->name('update');
});
Route::group(['prefix' => 'currency', 'as' => 'currency.'], function () {
    Route::get('list','CurrencyController@currencies')->name('index');
    Route::post('store','CurrencyController@store')->name('store');
    Route::post('update','CurrencyController@update')->name('update');
    Route::post('status/change','CurrencyController@statusChange')->name('status');
    Route::post('api-key/update','CurrencyController@updateApiKey')->name('api.update');
});

