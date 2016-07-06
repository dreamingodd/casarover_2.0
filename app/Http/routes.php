<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
require_once('routes/siteRoutes.php');
require_once('routes/backRoutes.php');
require_once('routes/apiRoutes.php');
require_once('routes/wxRoutes.php');
require_once('routes/mobileRoutes.php');

// Merchat
Route::get('pc-wx-login', 'PcWxLoginController@login');
Route::group(['prefix' => 'wx/pc-wx-login', 'middleware' => ['web', 'wx.auth']], function () {
    Route::get('option/{code}', 'PcWxLoginController@option');
    Route::get('approve', 'PcWxLoginController@approve');
    Route::get('reject', 'PcWxLoginController@reject');
    Route::get('check', 'PcWxLoginController@check');
});
Route::group(['prefix' => 'merchant', 'middleware' => ['web', 'pc.wx']], function() {
    Route::get('/', 'Merchant\ReserveController@index');
});

Route::get('dashboard',function(){
    return view('shop.orderList');
});

Route::get('login',function(){
    return view('shop.login');
});
