<?php

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

/** Routes for mobile phone. */
Route::group(['prefix' => 'm'],function () {
    Route::get('/home', 'M\HomeController@index');
    Route::get('/hotlists','M\HomeController@hotlists');
    Route::get('/themes','M\HomeController@themes');
    Route::get('/series','M\HomeController@series');
    Route::get('/area/{id}' , 'AreaController@show');
    Route::get('/casa/{id}' , 'M\CasaController@show');
    Route::get('/serie/{id}','CasaSeriesController@serie');
    Route::get('/allcasa/{id?}','CasaController@allcasa');
    Route::get('/theme/{id}','ThemeController@show');

    Route::get('/about', function(){
        return view('mobile.about');
    });
});
