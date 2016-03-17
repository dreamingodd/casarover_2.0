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
});
