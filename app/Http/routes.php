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

Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'SiteController@index');
    Route::get('/back', 'CasaController@casaList');
    Route::get('/back/casaList/{deleted?}', 'CasaController@casaList');
    Route::get('/back/casaEdit', 'CasaController@casaEdit');
    Route::get('/casa', 'CasaController@casaInfo');
    Route::get('/wechat', 'WechatController@index');
    Route::get('/back/participateList', 'WechatController@participateList');
    Route::get('/back/wechatSeriesList','WechatController@wechatSeriesList');
    Route::get('/back/wechatSeriesEdit','WechatController@wechatSeriesEdit');
    Route::get('/back/wechatList/{type?}/{deleted?}', 'WechatController@wechatList');
    Route::get('/back/wechatEdit', 'WechatController@wechatEdit');
    Route::post('/213', 'asd@asd');
});
