<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ExtraSettingController;

Route::group(['prefix' => 'extra', 'as' => 'extra.'], function () {
    Route::get('clear/cache', ['middleware' => 'acl:clear_cache', 'as' => 'clear.cache', 'uses' => 'ExtraSettingController@clearCache']);
    Route::get('system/info', ['middleware' => 'acl:system_info', 'as' => 'system.info', 'uses' => 'ExtraSettingController@systemInfo']);
});
