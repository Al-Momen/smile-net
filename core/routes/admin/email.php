<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'email-template',  'as' => 'email.template.'], function () {
    Route::get('global', ['as' => 'global', 'uses' => '\App\Http\Controllers\Admin\EmailTemplateController@emailTemplate']);
    Route::post('global/update', ['as' => 'global.update', 'uses' => '\App\Http\Controllers\Admin\EmailTemplateController@emailTemplateUpdate']);
    Route::get('setting', [ 'as' => 'setting', 'uses' => '\App\Http\Controllers\Admin\EmailTemplateController@emailSetting']);
    Route::post('setting/update', [ 'as' => 'setting.update', 'uses' => '\App\Http\Controllers\Admin\EmailTemplateController@emailSettingUpdate']);
    Route::get('list', [ 'as' => 'index', 'uses' => '\App\Http\Controllers\Admin\EmailTemplateController@index']);
    Route::get('id/{edit}', [ 'as' => 'edit', 'uses' => '\App\Http\Controllers\Admin\EmailTemplateController@edit']);
    Route::post('{id}/update', [ 'as' => 'update', 'uses' => '\App\Http\Controllers\Admin\EmailTemplateController@update']);
    Route::post('send-test-mail', [ 'as' => 'test.mail', 'uses' => '\App\Http\Controllers\Admin\EmailTemplateController@sendTestMail']);
});
