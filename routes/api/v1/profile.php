<?php

Route::get('/profile', 'Api\v1\ProfileController@getProfileInfo');

// Статистика посещаемости
Route::group(['prefix' => '/statistic'], function () {
    Route::get('/visit', 'Api\v1\ProfileController@getStatisticsVisitInfo');
});

// Справочник пользователей
Route::group(['prefix' => '/users'], function () {
    Route::get('/catalog', 'Api\v1\UserCatalogController@index');
    //Route::get('/catalog/{tab_no}', 'Api\v1\UserCatalogController@getUserProfile');
    //Route::get('/catalog/{tab_no}/visits', 'Api\v1\UserCatalogController@getUserVisitInfo');
});
