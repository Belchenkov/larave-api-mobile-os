<?php

Route::get('/profile', 'Api\v1\ProfileController@getProfileInfo')->name('profile');
Route::get('/badges', 'Api\v1\ProfileController@getBadges')->name('badges');
Route::get('/news', 'Api\v1\NewsController@index')->name('news');
Route::get('/news/{news}', 'Api\v1\NewsController@show')->name('news.show');

// Статистика посещаемости
Route::group(['prefix' => '/statistic', 'as' => 'statistic.'], function () {
    Route::get('/visit', 'Api\v1\ProfileController@getStatisticsVisitInfo')->name('visit');
});

// Справочник пользователей
Route::group(['prefix' => '/users', 'as' => 'catalog.'], function () {
    Route::get('/catalog', 'Api\v1\UserCatalogController@getCatalog')->name('getCatalog');
    Route::get('/catalog/{id_phperson}', 'Api\v1\UserCatalogController@getUserProfile')->name('getUserProfile');
    Route::get('/catalog/{id_phperson}/visits', 'Api\v1\UserCatalogController@getUserVisitInfo')->name('getUserVisitInfo');
});

// Кабинет согласования
Route::group(['prefix' => '/tasks/approval', 'as' => 'approval.tasks.'], function () {
    Route::get('/', 'Api\v1\ApprovalTaskController@getTasks')->name('getTasks');
    Route::get('/{task_id}', 'Api\v1\ApprovalTaskController@getTask')->name('getTask');
    Route::post('/{task_id}', 'Api\v1\ApprovalTaskController@updateTask')->name('updateTask');
    Route::get('/download/{doc_id}', 'Api\v1\ApprovalTaskController@downloadDocument')->name('downloadDocument');
});
