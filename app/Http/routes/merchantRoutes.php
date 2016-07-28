<?php

// Merchat
Route::get('pc-wx-login/{redirectUrl?}', 'PcWxLoginController@login');
Route::get('pc-wx-login/check/{code}', 'PcWxLoginController@check')->middleware(['web']);
Route::group(['prefix' => 'wx/pc-wx-login', 'middleware' => ['web', 'wx.auth']], function () {
    Route::get('option/{code}', 'PcWxLoginController@option');
    Route::get('approve/{code}', 'PcWxLoginController@approve');
    Route::get('reject/{code}', 'PcWxLoginController@reject');
});

Route::group(['prefix' => 'merchant', 'middleware' => ['web', 'pc.wx']], function() {
    Route::get('/', 'Merchant\ReserveController@index');
});

// 商家平台的接口数据
Route::group(['prefix' => 'api/merch', 'middleware' => ['web', 'pc.wx']], function() {
    Route::get('orderList/{type?}', 'Merchant\OrderController@index');
    Route::get('cardList','Merchant\VacationCardController@cardList');
    Route::post('changeorder','Merchant\OrderController@update');
    Route::get('delorder/{id}','Merchant\OrderController@del');
    Route::get('turnusedorder/{id}','Merchant\OrderController@turnused');
});
