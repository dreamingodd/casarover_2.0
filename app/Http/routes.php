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


Route::get('/', 'SiteController@index');
Route::get('/area/{id}' , 'AreaController@show');
Route::get('/casa/{id}' , 'CasaController@casaInfo');
Route::get('/casaseries/{type}/{series?}', 'CasaSeriesController@casas');
Route::get('/allcasa/{id?}','CasaController@allcasa');
Route::get('/wechat/{type?}/{series?}', 'WechatController@index');
Route::get('/oss/signature', 'OssController@execute');
Route::get('/theme/{id}','ThemeController@show');
Route::get('/about','SiteController@about');

//admin user
Route::group(['middleware' => ['web']], function () {
    Route::auth();
    Route::get('admin/login', 'Admin\AuthController@getLogin');
    Route::post('admin/login', 'Admin\AuthController@postLogin');
    Route::get('admin/logout','Admin\AuthController@logout');
    Route::get('admin/register', 'Admin\AuthController@getRegister');
    Route::post('admin/register', 'Admin\AuthController@postRegister');
    Route::get('admin/wait','Admin\AuthController@wait');
});

Route::group(['prefix' => 'back','middleware' => ['web', 'auth:admin']], function () {
    Route::get('/', 'SiteController@slide');
    Route::get('casaList/{deleted?}', 'CasaController@showList');
    Route::get('casaDel/{id}/{deleted}', 'CasaController@del');
    Route::get('casa/{id?}', 'CasaController@show');
    Route::post('casaEdit', 'CasaController@edit');
    Route::resource('areas','AreaController');
    Route::get('slide','SiteController@slide');
    Route::get('slide/add/{type}','SiteController@create');
    Route::get('slide/edit/{id}','SiteController@edit');
    Route::post('slidedel','SiteController@del');
    Route::post('slide/store','SiteController@store');
    Route::get('recom','RecomController@index');
    Route::post('recom/update','RecomController@update');
    Route::get('casarecom','RecomController@casa');
    Route::get('casaList/{deleted?}', 'CasaController@showList');
    Route::get('casaEdit', 'CasaController@casaEdit');
    Route::get('participateList', 'WechatController@participateList');
    Route::get('wechatSeriesList','WechatController@wechatSeriesList');
    Route::get('wechatSeriesadd','WechatController@wechatSeriesCreate');
    Route::post('wechatSeriesStore','WechatController@wechatSeriesStore');
    Route::get('wechatSeriesEdit/{id}','WechatController@wechatSeriesEdit');
    Route::post('wechatSeriesDel','WechatController@wechatSeriesDel');
    Route::get('wechatList/{type?}/{deleted?}', 'WechatController@wechatList');
    Route::get('wechatDel/{id?}/{deleted?}', 'WechatController@del');
    Route::post('wechatEdit/{id?}', 'WechatController@wechatEdits');
    Route::get('wechatEdit/{id?}', 'WechatController@wechatEdit');
    Route::get('theme','ThemeController@index');
    Route::get('theme/add','ThemeController@create');
    Route::post('theme/store','ThemeController@store');
    Route::get('theme/edit/{id}','ThemeController@edit');
    Route::post('theme/del','ThemeController@del');
    Route::get('theme/article','ThemeController@article');
    Route::get('theme/article/add','ThemeController@articleCreate');
    Route::post('theme/article/store','ThemeController@articleStore');
    Route::get('theme/article/edit/{id}','ThemeController@articleEdit');
    Route::post('theme/article/del/','ThemeController@articleDel');
    Route::get('sucess/{type?}/{id?}', 'BackController@sucess');
    Route::get('fail', 'BackController@fail');
    Route::get('areaslide','SiteController@areaSlide');
    Route::get('api/wxorder/list/{page?}/{type?}','Wx\WxOrderController@orderlist');
    Route::post('api/wxorder/del/','Wx\WxOrderController@del');
    Route::get('shareactiv','Wx\Activity18Controller@selcasas');
    Route::get('api/eighteen/add/{id}','Wx\Activity18Controller@add');
    Route::get('api/eighteen/del/{id}','Wx\Activity18Controller@del');
    Route::get('system/wx/user','Wx\WxUserController@showList');
    Route::get('system/wx/user/test/register/{id}','Wx\WxUserController@registerTester');
    Route::get('system/wx/user/test/unregister/{id}','Wx\WxUserController@unregisterTester');

    Route::get('vacation', 'Wx\WxCasaController@vacation');
    Route::get('vacation/edit/{id}', 'Wx\WxCasaController@vacationEdit');
});

/**
 * api route ，use for Vue，
**/
Route::group(['prefix' => 'api'], function () {
    Route::get('home/recom/{id?}', 'Api\HomeController@getCasasByCityId');
    Route::get('home/series/', 'Api\HomeController@getSeries');
    Route::get('home/themes/', 'Api\HomeController@getThemes');
    Route::get('casa/recom/{id?}', 'Api\CasaController@getCasasById');
    Route::get('casa/slim/all', 'Api\CasaController@getSlimCasas');
    Route::post('/recom/save/', 'Api\CasaController@save');
    Route::post('/theme/change/', 'Api\ThemeController@setchange');
    Route::post('/wechat/change/', 'Api\WechatController@setchange');
    Route::get('theme/article/{id}', 'Api\ThemeController@getThemeArticle');
    //民宿大全
    Route::get('areas/{id?}','Api\AllCasaController@getAreasByCityId');
    Route::get('casas/city/{id?}/areas/{areas?}','Api\AllCasaController@getCasas');
    //民宿分享活动
    Route::get('/eighteen/','Wx\Activity18Controller@sellist');
});

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
    Route::get('/bill', 'Wx\WxSiteController@bill');
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

Route::group(['prefix' => 'back/wx', 'middleware' => ['web','auth:admin']],function () {
    Route::get('/', 'Wx\WxCasaController@showList');
    Route::get('trash/{deleted}', 'Wx\WxCasaController@showList');
    Route::get('casa/{id?}', 'Wx\WxCasaController@show');
    Route::post('casa/edit', 'Wx\WxCasaController@edit');
    Route::get('casa/del/{id?}', 'Wx\WxCasaController@del');
    Route::get('casa/restore/{id?}', 'Wx\WxCasaController@restore');
    Route::get('room/{id}', 'Wx\WxRoomController@show');
    Route::post('room/edit', 'Wx\WxRoomController@edit');
    Route::get('order/list','Wx\WxOrderController@index');
    Route::get('room/date/{id}', 'Wx\WxRoomController@date');
    Route::post('changewxordertype','Wx\WxOrderController@editStatus');
    Route::post('room/date/{id}', 'Wx\WxRoomController@postdate');
    Route::get('bind', 'Wx\WxBindController@bindList');
    Route::get('bind/trash/{deleted}', 'Wx\WxBindController@bindList');
    Route::get('bind/delete/{id}', 'Wx\WxBindController@delete');
    Route::get('bind/restore/{id}', 'Wx\WxBindController@restore');
    Route::get('bind/{bindId}/{casaId}', 'Wx\WxBindController@bind');
    Route::get('casa/test/set/{id}', 'Wx\WxCasaController@setTest');
    Route::get('casa/test/unset/{id}', 'Wx\WxCasaController@unsetTest');
});

/** Routes for mobile phone. */
Route::group(['prefix' => 'mobile'],function () {
    Route::get('/about', function(){
        return view('mobile.about');
    });
    Route::get('/area/{id}' , 'AreaController@show');
    Route::get('/home', 'SiteController@index');
    Route::get('/casa/{id}' , 'CasaController@casaInfo');
    Route::get('/casaseries/{type}/{series?}', 'CasaSeriesController@casas');
    Route::get('/allcasa/{id?}','CasaController@allcasa');
    Route::get('/theme/{id}','ThemeController@show');
});
//Route::get('user/{id}', function ($id) {
//        Route::get('/$id',function (
//         return view('site.home');
//     ));
//});
Route::get('user/profile', ['as' => 'profile', function () {
    dd(1);
}]);
