<?php

Route::get('/profile', 'Api\v1\ProfileController@getProfileInfo')->name('profile');
Route::get('/badges', 'Api\v1\ProfileController@getBadges')->name('badges');
Route::get('/news', 'Api\v1\NewsController@index')->name('news');
Route::get('/news/{news}', 'Api\v1\NewsController@show')->name('news.show');

Route::get('/information/offices', 'Api\v1\OfficesController@index')->name('offices');

Route::group(['prefix' => '/request/pass', 'as' => 'request.pass.'], function () {
    Route::get('/', 'Api\v1\PassRequestController@index')->name('list');
    Route::get('/{id}', 'Api\v1\PassRequestController@show')->name('show');
    Route::post('/create', 'Api\v1\PassRequestController@store')->name('create');
});

// Статистика посещаемости
Route::group(['prefix' => '/statistic', 'as' => 'statistic.'], function () {
    Route::get('/visit', 'Api\v1\ProfileController@getStatisticsVisitInfo')->name('visit');
});

// Справочник пользователей
Route::group(['prefix' => '/users', 'as' => 'catalog.'], function () {
    Route::get('/catalog', 'Api\v1\UserCatalogController@getCatalog')->name('list');
    Route::get('/catalog/{id_phperson}', 'Api\v1\UserCatalogController@getUserProfile')->name('profile');
    Route::get('/catalog/{id_phperson}/visits', 'Api\v1\UserCatalogController@getUserVisitInfo')->name('visits');
});

// Кабинет согласования
Route::group(['prefix' => '/tasks/approval', 'as' => 'approval.tasks.'], function () {
    Route::get('/', 'Api\v1\ApprovalTaskController@getTasks')->name('list');
    Route::get('/{task_id}', 'Api\v1\ApprovalTaskController@getTask')->name('show');
    Route::post('/{task_id}', 'Api\v1\ApprovalTaskController@updateTask')->name('update');
    Route::get('/download/{doc_id}', 'Api\v1\ApprovalTaskController@downloadDocument')->name('download');
});
