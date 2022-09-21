<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'payment/gateway', 'as' => 'gateway.'], function () {
        //Automatic Gateway
        Route::group(['prefix' => 'automatic', 'as' => 'automatic.'], function () {
            Route::get('index', ['middleware' => 'acl:view_payment_gateway', 'as' => 'index', 'uses' => '\App\Http\Controllers\Admin\GatewayController@index']);
            Route::get('edit/{alias}', ['middleware' => 'acl:payment_gateway_edit', 'as' => 'edit', 'uses' => '\App\Http\Controllers\Admin\GatewayController@edit']);
            Route::post('update/{alias}', ['middleware' => 'acl:payment_gateway_update', 'as' => 'update','uses' => '\App\Http\Controllers\Admin\GatewayController@update']);
            Route::post('remove/{alias}', ['middleware' => 'acl:payment_gateway_remove', 'as' => 'remove','uses' => '\App\Http\Controllers\Admin\GatewayController@remove']);
            Route::post('status/change', ['middleware' => 'acl:payment_gateway_status_change', 'as' => 'status','uses' => '\App\Http\Controllers\Admin\GatewayController@statusChange']);
        });
        // Manual Methods
        Route::group(['prefix' => 'manual', 'as' => 'manual.'], function () {
            Route::get('index', ['middleware' => 'acl:manual_gateway_list', 'as' => 'index', 'uses' => '\App\Http\Controllers\Admin\ManualGatewayController@index']);
            Route::get('new', ['middleware' => 'acl:manual_gateway_new', 'as' => 'new', 'uses' => '\App\Http\Controllers\Admin\ManualGatewayController@new']);
            Route::post('store', ['middleware' => 'acl:manual_gateway_store', 'as' => 'store', 'uses' => '\App\Http\Controllers\Admin\ManualGatewayController@store']);
            Route::get('edit/{id}', ['middleware' => 'acl:manual_gateway_edit', 'as' => 'edit', 'uses' => '\App\Http\Controllers\Admin\ManualGatewayController@edit']);
            Route::post('update/{id}', ['middleware' => 'acl:manual_gateway_update', 'as' => 'update','\App\Http\Controllers\Admin\ManualGatewayController@update']);
            Route::post('status/change', ['middleware' => 'acl:manual_gateway_status_change', 'as' => 'status', '\App\Http\Controllers\Admin\ManualGatewayController@statusChange']);
        });
});
