<?php

Route::get('/profile', 'Api\v1\ProfileController@getProfileInfo')->name('profile');

// Статистика посещаемости
Route::group(
    [
        'prefix' => '/statistic',
        'as' => 'statistic.'
    ],
    function () {
    Route::get('/visit', 'Api\v1\ProfileController@getStatisticsVisitInfo')->name('visit');
});

// Справочник пользователей
Route::group(
    [
        'prefix' => '/users',
        'as' => 'catalog.'
    ], function () {
    Route::get('/catalog', 'Api\v1\UserCatalogController@getCatalog')->name('getCatalog');
    Route::get('/catalog/{tab_no}', 'Api\v1\UserCatalogController@getUserProfile')->name('getUserProfile');
    Route::get('/catalog/{tab_no}/visits', 'Api\v1\UserCatalogController@getUserVisitInfo')->name('getUserVisitInfo');
});
