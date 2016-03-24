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
Route::resource('areas','AreaController');
Route::get('/casa', 'CasaController@casaInfo');
Route::get('/wechat', 'WechatController@index');

Route::group(['prefix' => 'back','middleware' => ['web']], function () {
    Route::get('/', 'CasaController@casaList');
    Route::get('casaList/{deleted?}', 'CasaController@showList');
    Route::get('casaDel/{id}/{deleted}', 'CasaController@del');
    Route::get('casa/{id}', 'CasaController@show');
    Route::post('casaEdit', 'CasaController@edit');
    Route::resource('areas','backend\AreaController');
    Route::get('casaList/{deleted?}', 'CasaController@showList');
    Route::get('casaEdit', 'CasaController@casaEdit');
    Route::get('/casa', 'CasaController@casaInfo');
    Route::get('participateList', 'WechatController@participateList');
    Route::get('wechatSeriesList','WechatController@wechatSeriesList');
    Route::get('wechatSeriesEdit','WechatController@wechatSeriesEdit');
    Route::post('wechatSeriesEdits','WechatController@wechatSeriesEdits');
    Route::get('wechatList/{type?}/{deleted?}', 'WechatController@wechatList');
    // Route::get('wechatListdel/{type}/{deleted}', 'WechatController@del');
    Route::get('wechatEdit', 'WechatController@wechatEdit');
});

/**
 * api route ，use for Vue，
**/
Route::group(['prefix' => 'api'],function () {
    Route::get('home/recom/{cityid?}','api\HomeController@getCasasByCityId');
});
