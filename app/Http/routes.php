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
Route::get('/area/{id}','AreaController@show');
Route::get('/casa', 'CasaController@casaInfo');
Route::get('/wechat', 'WechatController@index');
Route::get('/oss/signature', 'OssController@execute');

Route::group(['prefix' => 'back','middleware' => ['web']], function () {
    Route::get('/', 'CasaController@casaList');
    Route::get('casaList/{deleted?}', 'CasaController@showList');
    Route::get('casaDel/{id}/{deleted}', 'CasaController@del');
    Route::get('casa/{id?}', 'CasaController@show');
    Route::post('casaEdit', 'CasaController@edit');
    Route::resource('areas','backend\AreaController');
    Route::get('wechatList/{type}/{deleted?}', 'WechatController@wechatList');
});

/**
 * api route ，use for Vue，
**/
Route::group(['prefix' => 'api'],function () {
    Route::get('home/recom/{id?}','api\HomeController@getCasasByCityId');
});
