<?php

/**
* this is api for mobile site
* use for vue
**/

Route::group(['prefix' => 'm'],function () {
    Route::get('/home', 'M\HomeController@index');
    Route::get('/hotlists','M\HomeController@hotlists');
    Route::get('/themes','M\HomeController@themes');
    Route::get('/series','M\HomeController@series');
    Route::get('areas','Api\AllCasaController@areas');
    Route::get('/area/{id}' , 'M\AreaController@show');
    Route::get('/casa/{id}' , 'M\CasaController@show');
    Route::get('/serie/{id}','CasaSeriesController@serie');
    Route::get('/allcasa/{id?}','CasaController@allcasa');
    Route::get('/theme/{id}','M\ThemeController@show');
    Route::get('/casas/{cityId?}/{areas?}','M\AllCasaController@index');
});
