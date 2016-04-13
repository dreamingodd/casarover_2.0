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
Route::get('/casaserise/{type}/{series?}', 'CasaSeriesController@casas');
Route::get('/about', function(){return view('site.about');});
Route::get('/allcasa','CasaController@allcasa');
Route::get('/wechat/{type?}/{series?}', 'WechatController@index');
Route::get('/oss/signature', 'OssController@execute');
Route::get('/wechatbook', 'WechatController@book');
Route::get('/bookdetails', 'WechatController@bookdetails');
Route::get('/bookpay', 'WechatController@bookpay');
Route::get('/wechatperson', 'WechatController@wechatperson');
Route::get('/theme/{id}','ThemeController@show');

Route::group(['prefix' => 'back','middleware' => ['web']], function () {
    Route::get('/', 'CasaController@casaList');
    Route::get('casaList/{deleted?}', 'CasaController@showList');
    Route::get('casaDel/{id}/{deleted}', 'CasaController@del');
    Route::get('casa/{id?}', 'CasaController@show');
    Route::post('casaEdit', 'CasaController@edit');
    Route::resource('areas','AreaController');
    Route::get('slide','SiteController@slide');
    Route::get('slide/add','SiteController@create');
    Route::get('slide/edit/{id}','SiteController@edit');
    Route::post('slide/del/{id}','SiteController@del');
    Route::post('slide/store','SiteController@store');
    Route::get('recom','RecomController@index');
    Route::post('recom/update','RecomController@update');
    Route::get('casarecom','RecomController@casa');
    Route::get('casaList/{deleted?}', 'CasaController@showList');
    Route::get('casaEdit', 'CasaController@casaEdit');
    Route::get('/casa', 'CasaController@casaInfo');
    Route::get('participateList', 'WechatController@participateList');
    Route::get('wechatSeriesList','WechatController@wechatSeriesList');
    Route::post('wechatSeriesList','WechatController@wechatSeriesEdits');
    Route::get('wechatSeriesEdit','WechatController@wechatSeriesEdit');
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
    Route::post('theme/article/del/{id}','ThemeController@articleDel');

    Route::get('sucess/{type?}/{id?}', 'BackController@sucess');
    Route::get('fail', 'BackController@fail');
});

/**
 * api route ，use for Vue，
**/
Route::group(['prefix' => 'api'],function () {
    Route::get('home/recom/{id?}','api\HomeController@getCasasByCityId');
    Route::get('home/series/','api\HomeController@getSeries');
    Route::get('home/themes/','api\HomeController@getThemes');
    Route::get('casa/recom/{id?}','api\CasaController@getCasasById');
    Route::post('/recom/save/','api\CasaController@save');
    Route::get('theme/article/{id}','api\ThemeController@getThemeArticle');
});

/**
 * wechat public routes
 */
Route::group(['prefix' => 'wx'],function () {
    Route::get('/', 'Wx\WxCasaController@showList');
});
