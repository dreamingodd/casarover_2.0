<?php

// soap：重量级协议，如果对安全性要求很高，建议改成这种方式。
Route::group(['prefix' => 'soap'], function(){
    Route::any('simple-call', 'SoapTest\SoapServer@test');
    Route::any('simple-test', 'SoapTest\SoapClient@test');
    Route::any('coupon-call', 'SoapTest\CouponServer@test');
    Route::any('coupon-test', 'SoapTest\CouponClient@test');
});

// Restful：simple json, what I choose to use for now 20160727.
Route::group(['prefix' => 'rest'], function(){
    Route::any('simple-call', 'RestTest\SimpleServer@test');
    Route::any('simple-test', 'RestTest\SimpleClient@test');
    Route::any('get-new-coupon', 'RESTful\CouponRestfulServer@getNewCoupon');
    Route::any('get-coupon', 'RESTful\CouponRestfulServer@getCoupon');
});
