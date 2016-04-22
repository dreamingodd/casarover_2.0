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

use App\Task;
use Illuminate\Http\Request;

Route::get('/', 'SiteController@index');
Route::get('/area/{id}' , 'AreaController@show');
Route::get('/casa/{id}' , 'CasaController@casaInfo');
Route::get('/casaseries/{type}/{series?}', 'CasaSeriesController@casas');
Route::get('/allcasa','CasaController@allcasa');
Route::get('/wechat/{type?}/{series?}', 'WechatController@index');
Route::get('/oss/signature', 'OssController@execute');
Route::get('/theme/{id}','ThemeController@show');
Route::get('/about', function(){
    return view('site.about');
});


Route::group(['prefix' => 'back','middleware' => ['web']], function () {
    Route::get('/', 'SiteController@slide');
    Route::get('casaList/{deleted?}', 'CasaController@showList');
    Route::get('casaDel/{id}/{deleted}', 'CasaController@del');
    Route::get('casa/{id?}', 'CasaController@show');
    Route::post('casaEdit', 'CasaController@edit');
    Route::resource('areas','AreaController');
    Route::get('slide','SiteController@slide');
    Route::get('slide/add','SiteController@create');
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
});

/**
 * api route ，use for Vue，
**/
Route::group(['prefix' => 'api'],function () {
    Route::get('home/recom/{id?}','Api\HomeController@getCasasByCityId');
    Route::get('home/series/','Api\HomeController@getSeries');
    Route::get('home/themes/','Api\HomeController@getThemes');
    Route::get('casa/recom/{id?}','Api\CasaController@getCasasById');
    Route::get('casa/slim/all', 'Api\CasaController@getSlimCasas');
    Route::post('/recom/save/','Api\CasaController@save');
    Route::post('/theme/change/','Api\ThemeController@setchange');
    Route::post('/wechat/change/','Api\WechatController@setchange');
    Route::get('theme/article/{id}','Api\ThemeController@getThemeArticle');
    //民宿大全
    Route::get('areas/{id?}','Api\AllCasaController@getAreasByCityId');
    Route::get('casas/city/{id?}/areas/{areas?}','Api\AllCasaController@getCasas');
});

/**
 * wechat public routess
 */
Route::group(['prefix' => 'wx'],function () {
    Route::get('/', 'Wx\WxSiteController@index');
    Route::get('/casa/{id}', 'Wx\WxSiteController@casa');
    Route::get('/user', 'Wx\WxSiteController@user');
    Route::get('/order', 'Wx\WxSiteController@order');
});
Route::group(['prefix' => 'back/wx', 'middleware' => ['web']],function () {
    Route::get('/', 'Wx\WxCasaController@showList');
    Route::get('trash/{deleted}', 'Wx\WxCasaController@showList');
    Route::get('casa/{id?}', 'Wx\WxCasaController@show');
    Route::post('casa/edit', 'Wx\WxCasaController@edit');
    Route::get('casa/del/{id?}', 'Wx\WxCasaController@del');
    Route::get('casa/restore/{id?}', 'Wx\WxCasaController@restore');
    Route::get('room/{id}', 'Wx\WxRoomController@show');
    Route::post('room/edit', 'Wx\WxRoomController@edit');
});

/** Routes for mobile phone. */
Route::group(['prefix' => 'mobile'],function () {
    Route::get('/home', 'SiteController@index');
    Route::get('/casa/{id}' , 'CasaController@casaInfo');
    Route::get('/casaseries/{type}/{series?}', 'CasaSeriesController@casas');
    Route::get('/allcasa','CasaController@allcasa');
    Route::get('/theme/{id}','ThemeController@show');
});
