<?php

/**
 * api route ，use for Vue，
**/
Route::group(['prefix' => 'api'], function () {
    Route::get('home/recom/{id?}', 'Api\HomeController@getCasasByCityId');
    Route::get('home/series', 'Api\HomeController@getSeries');
    Route::get('home/themes', 'Api\HomeController@getThemes');
    Route::get('casa/recom/{id?}', 'Api\CasaController@getCasasById');
    Route::get('casa/slim/all', 'Api\CasaController@getSlimCasas');
    Route::post('/theme/change', 'Api\ThemeController@setchange');
    Route::post('/wechat/change', 'Api\WechatController@setchange');
    Route::get('theme/article/{id}', 'Api\ThemeController@getThemeArticle');
    //民宿大全
    Route::get('areas/{id?}','Api\AllCasaController@getAreasByCityId');
    Route::get('casas/city/{id?}/areas/{areas?}','Api\AllCasaController@getCasas');
    //民宿分享活动
    Route::get('/eighteen','Wx\Activity18Controller@sellist');
});
