<?php

Route::get('/', 'SiteController@index');
Route::get('/area/{id}' , 'AreaController@show');
Route::get('/casa/{id}' , 'CasaController@casaInfo');
Route::get('/casaseries/{type}/{series?}', 'CasaSeriesController@casas');
Route::get('/allcasa/{id?}','CasaController@allcasa');
Route::get('/theme/{id}','ThemeController@show');
Route::get('/about','SiteController@about');
