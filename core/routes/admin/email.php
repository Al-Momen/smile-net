<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'email-template',  'as' => 'email.template.'], function () {
    Route::get('global', ['middleware' => 'acl:view_email_template_global', 'as' => 'global', 'uses' => 'EmailTemplateController@emailTemplate']);
    Route::post('global/update', ['middleware' => 'acl:email_template_global_update', 'as' => 'global.update', 'uses' => 'EmailTemplateController@emailTemplateUpdate']);
    Route::get('setting', ['middleware' => 'acl:email_template_setting', 'as' => 'setting', 'uses' => 'EmailTemplateController@emailSetting']);
    Route::post('setting/update', ['middleware' => 'acl:email_template_setting_update', 'as' => 'setting.update', 'uses' => 'EmailTemplateController@emailSettingUpdate']);
    Route::get('list', ['middleware' => 'acl:email_template_list', 'as' => 'index', 'uses' => 'EmailTemplateController@index']);
    Route::get('id/{edit}', ['middleware' => 'acl:email_template_edit', 'as' => 'edit', 'uses' => 'EmailTemplateController@edit']);
    Route::post('{id}/update', ['middleware' => 'acl:email_template_update', 'as' => 'update', 'uses' => 'EmailTemplateController@update']);
    Route::post('send-test-mail', ['middleware' => 'acl:send_test_mail', 'as' => 'test.mail', 'uses' => 'EmailTemplateController@sendTestMail']);
});
