<?php

// 类似于微信的页面模板
Route::get('/wechat/{type?}/{series?}', 'WechatController@index');
// 微信支付返回数据接收
Route::post('/wx/pay/notify', 'Wx\WxPayController@notify');
/** wechat public routess */
Route::group(['prefix' => 'wx', 'middleware' => ['web', 'wx.auth']],function () {
    Route::get('/', 'Wx\WxSiteController@index');
    // User scan the QR code on the back of the card.
    Route::get('/credit_score', 'Wx\WxSiteController@creditScore');
    Route::get('/casa/{id}/{collection?}', 'Wx\WxSiteController@casa');
    Route::get('/user', 'Wx\WxSiteController@user');
    Route::get('/api/user','Wx\WxSiteController@userinfo');
    Route::get('scorevariation/','Wx\WxSiteController@scoreVariation');
    Route::get('/api/scorevariation/{id}/{page?}','Wx\WxSiteController@scoreVariationJson');
    Route::get('registerMember/','Wx\WxSiteController@registerMember');
    Route::get('/orderdetails', 'Wx\WxSiteController@orderDetails');
    Route::get('/confirm', 'Wx\WxSiteController@confirm');
    Route::get('/order/{id}', 'Wx\WxSiteController@order');
    Route::get('/order/detail/{id}', 'Wx\WxOrderController@show');
    Route::post('/order/create', 'Wx\WxOrderController@create');
    Route::post('/order/del/{id}', 'Wx\WxOrderController@del ');
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
    //  buy
    Route::get('cardCasaList','Vacation\VacationCardController@index');
    Route::get('/api/cardCasaList','Vacation\VacationCardController@showlist');
    Route::get('/api/cardCasa/{id}','Vacation\VacationCardController@show');
    Route::post('/api/cardCasaBuy','Vacation\VacationCardController@buy');
    Route::post('/api/checkCoupon','Vacation\VacationCardController@checkCoupon');
    //  card message
    Route::get('/user/cards', 'Vacation\VacationCardController@cards');
    Route::get('/user/cardCasa/{id?}', 'Vacation\VacationCardController@cardCasa');

    Route::get('/user/cardEntry', 'Vacation\VacationOpportunityController@cardEntry');
    Route::get('/api/user/cardCasa/{id?}', 'Vacation\VacationOpportunityController@cardCasaJson');
    Route::get('/user/card/prepare/book/{id}','Vacation\VacationOpportunityController@prepareBook');
    Route::post('/user/card/book','Vacation\VacationOpportunityController@book');
    //Application record
    Route::get('/user/card/applied/list', 'Vacation\VacationOpportunityController@appliedList');
    Route::get('/user/card/apply/list', 'Vacation\VacationOpportunityController@applyList');
    //approve or not
    Route::get('/user/card/apply/approve/{id}', 'Vacation\VacationOpportunityController@applyApprove');
    Route::get('/user/card/apply/reject/{id}', 'Vacation\VacationOpportunityController@applyReject');

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
