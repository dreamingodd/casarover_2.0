<?php

// OSS 签名
Route::get('/oss/signature', 'OssController@execute');

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
    Route::get('/', 'SlideController@slide');
    Route::get('slide','SlideController@slide');
    Route::get('slide/add/{type}','SlideController@create');
    Route::get('slide/edit/{id}','SlideController@edit');
    Route::post('slidedel','SlideController@del');
    Route::post('slide/store','SlideController@store');

    Route::get('recom','RecomController@index');
    Route::post('recom/update','RecomController@update');
    Route::get('casarecom','RecomController@casa');
    Route::post('api/recom/save', 'RecomController@save');

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

    Route::get('casaList/{deleted?}', 'CasaController@showList');
    Route::get('casaDel/{id}/{deleted}', 'CasaController@del');
    Route::get('casa/realDel/{id}/', 'CasaController@realDel');
    Route::get('casa/{id?}', 'CasaController@show');
    Route::post('casaEdit', 'CasaController@edit');
    Route::resource('areas','AreaController');


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
    Route::get('sucess/{type?}/{id?}', 'BackController@sucess');
    Route::get('fail', 'BackController@fail');
    Route::get('areaslide','SlideController@areaSlide');
    Route::get('api/wxorder/list/{page?}/{type?}','Wx\WxOrderController@orderlist');
    Route::post('api/wxorder/del/','Wx\WxOrderController@del');
    Route::get('shareactiv','Wx\Activity18Controller@selcasas');
    Route::get('api/eighteen/add/{id}','Wx\Activity18Controller@add');
    Route::get('api/eighteen/del/{id}','Wx\Activity18Controller@del');

    // 用户管理
    Route::get('system/user','UserController@showList');
    Route::get('system/user/test/register/{id}/{page}','UserController@registerTester');
    Route::get('system/user/test/unregister/{id}/{page}','UserController@unregisterTester');

    // 度假卡参加民宿管理
    Route::get('vacation', 'Wx\WxCasaController@vacation');
    Route::get('vacation/del/{id}', 'Wx\WxCasaController@vacationDel');
    Route::get('vacation/edit/{id?}', 'Wx\WxCasaController@vacationEdit');
    Route::post('vacation/edit/{id?}', 'Wx\WxCasaController@vacationEdited');
    Route::get('vacation/casaAdd/{id}/{casa}', 'Wx\WxCasaController@vacationCasaAdd');
    Route::get('vacation/casaDel/{id}/{casa}', 'Wx\WxCasaController@vacationCasaDel');

    Route::get('vacation/casa','Mall\VacationCardController@back');
    Route::get('api/vacation/casa','Mall\VacationCardController@casalist');
    Route::get('api/vacation/add/{id}','Mall\VacationCardController@create');
    Route::get('api/vacation/del/{id}','Mall\VacationCardController@del');
    Route::post('api/vacation/update','Mall\VacationCardController@update');
});


Route::group(['prefix' => 'back/wx', 'middleware' => ['web','auth:admin']],function () {
    Route::get('/', 'Wx\WxCasaController@showList');
    Route::get('trash/{deleted}', 'Wx\WxCasaController@showList');
    Route::get('casa/{id?}', 'Wx\WxCasaController@show');
    Route::post('casa/edit', 'Wx\WxCasaController@edit');
    Route::get('casa/del/{id?}', 'Wx\WxCasaController@del');
    Route::get('casa/restore/{id?}', 'Wx\WxCasaController@restore');
    Route::get('casa/display/order/{id}/{order}','Wx\WxCasaController@updateDisplayOrder');
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
