<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ExtraSettingController;

Route::group(['prefix' => 'extra', 'as' => 'extra.'], function () {
    Route::get('clear/cache', ['middleware' => 'acl:clear_cache', 'as' => 'clear.cache', 'uses' => '\App\Http\Controllers\Admin\ExtraSettingController@clearCache']);
    Route::get('system/info', ['middleware' => 'acl:system_info', 'as' => 'system.info', 'uses' => '\App\Http\Controllers\Admin\ExtraSettingController@systemInfo']);
});
