<?php
/*
 *  Статистика посещаемости
 */
Route::group([
    'middleware' => 'auth:api'
], function () {
    Route::get('/', 'Api\v1\StatisticsVisitController@getStatisticsVisitInfo');
});
