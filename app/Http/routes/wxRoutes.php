<?php

/**
 * wechat public routess
 */
Route::post('/wx/pay/notify', 'Wx\WxPayController@notify');
Route::group(['prefix' => 'wx', 'middleware' => ['web', 'wx.auth']],function () {
    Route::get('/', 'Wx\WxSiteController@index');
    // User scan the QR code on the back of the card.
    Route::get('/credit_score', 'Wx\WxSiteController@creditScore');
    Route::get('/casa/{id}/{collection?}', 'Wx\WxSiteController@casa');
    Route::get('/user', 'Wx\WxSiteController@user');
    Route::get('/scorevariation/','Wx\WxSiteController@scoreVariation');
    Route::get('/api/scorevariation/{id}/{page?}','Wx\WxSiteController@scoreVariationJson');
    Route::get('/registerMember/','Wx\WxSiteController@registerMember');
    Route::get('/orderdetails', 'Wx\WxSiteController@orderDetails');
    Route::get('/confirm', 'Wx\WxSiteController@confirm');
    Route::get('/bill', function(){
        return view('wx.wxBill');
    });
    Route::get('/order/{id}', 'Wx\WxSiteController@order');
    Route::get('/order/detail/{id}', 'Wx\WxOrderController@show');
    Route::post('/order/create', 'Wx\WxOrderController@create');
    Route::get('/pay/wxorder/{id}', 'Wx\WxPayController@prepare');
    Route::get('/collection', 'Wx\WxSiteController@collection');
    Route::post('/collection', 'Wx\WxSiteController@collectionDel');
    // Merchant entry
    Route::get('/bind', 'Wx\WxBindController@index');
    Route::post('/bind/apply', 'Wx\WxBindController@apply');
    Route::get('/consume/{id}', 'Wx\WxOrderController@consume');
    Route::get('/consume_cancel/{id}', 'Wx\WxOrderController@cancelConsume');
    Route::get('/logout', 'Wx\WxSiteController@logout');
    // Check whether user subscribe us.
    Route::get('subscribe', 'Wx\Activity18Controller@checkSubscription');
    // vacation card
    Route::get('cardCasaList','Mail\VacationCardController@index');
    Route::get('/user/card/{id?}', 'Mail\VacationCardController@card');
    Route::get('/user/cardCasa/{id?}', 'Mail\VacationCardController@cardCasa');
    Route::get('/user/cardBook', function(){
        return view('wx.cardBook');
    });
    Route::get('/user/cardEntry', function(){
        return view('wx.cardEntry');
    });
    Route::get('/user/cardApply/{id?}', function(){
        return view('wx.cardApply');
    });
    Route::get('/user/cardApplySend/{id?}', function(){
        return view('wx.cardApplySend');
    });
    Route::get('/user/cardForm', function(){
        return view('wx.cardForm');
    });
    Route::get('/user/cardBill', function(){
        return view('wx.cardBill');
    });
    Route::get('/address', 'Mail\VacationCardController@address');
    // vote activity
    Route::group(['prefix' => 'date'],function () {
        Route::get('/', 'Wx\Activity18Controller@index');
        Route::get('/casa/{id}', 'Wx\Activity18Controller@show');
        Route::get('rank/entry/{id?}', 'Wx\Activity18Controller@rankEntry');
        Route::get('/rank/{id?}', 'Wx\Activity18Controller@rank');
        Route::get('/datesleep/{id}/{user_id}', 'Wx\Activity18Controller@datesleep');
        Route::get('/vote/{id}/{user_id}','Wx\Activity18Controller@vote');
        Route::get('subscribe/test', 'Wx\Activity18Controller@subscribeTest');
    });
});
