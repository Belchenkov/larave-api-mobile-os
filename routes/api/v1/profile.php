<?php

Route::group([
    'middleware' => 'auth:api'
], function () {
    Route::get('/', 'Api\v1\ProfileController@getProfileInfo');

    // Статистика посещаемости
    Route::group([
        'prefix' => '/statistic-visit'
    ], function () {
        Route::get('/', 'Api\v1\ProfileController@getStatisticsVisitInfo');
    });

});

