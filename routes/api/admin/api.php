<?php

// JWT Auth routes
Route::group(['middleware' => ['protector']], function () {
    Route::post('auth/login', 'Api\Admin\AuthorizationController@loginJwt')->name('admin.login');
    Route::post('auth/refresh', 'Api\Admin\AuthorizationController@refreshJwt')->name('refresh');

    Route::group(['middleware' => ['auth:api', 'admin'], 'as' => 'admin.'], function () {
        Route::post('auth/logout', 'Api\Admin\AuthorizationController@logout')->name('logout');

        Route::get('profile', 'Api\Admin\AuthorizationController@profile')->name('profile');

        Route::post('sessions/clear', 'Api\Admin\AuthorizationController@sessionClear')->name('session.clear');
        Route::get('sessions/{id_phperson}', 'Api\Admin\AuthorizationController@showUserSessions')->name('sessions');
        Route::post('sessions/{id_phperson}', 'Api\Admin\AuthorizationController@deleteUserSessions')->name('sessions.delete');

        // Settings
        Route::get('settings/{id_phperson}', 'Api\Admin\UsersController@getSettingsForUser')->name('settings.get');
        Route::post('settings/show-kip-change', 'Api\Admin\UsersController@showKipChange')->name('settings.show.kip.change');

        Route::get('admins/list', 'Api\Admin\AdminsController@index')->name('admins');

        Route::get('/users/catalog', 'Api\Admin\UsersController@getCatalog')->name('users');
        Route::get('/users/catalog/{id_phperson}', 'Api\Admin\UsersController@getUserProfile')->name('users.profile');
        Route::get('/users/catalog/{id_phperson}/visits', 'Api\Admin\UsersController@getUserVisitInfo')->name('users.visits');
        Route::get('/users/catalog/{id_phperson}/approval', 'Api\Admin\UsersController@getUserApprovalTasks')->name('users.approval');

        Route::get('/mailing', 'Api\Admin\MailingController@index')->name('mailing');
        Route::post('/mailing/create', 'Api\Admin\MailingController@store')->name('mailing.create');

        Route::get('/news', 'Api\Admin\NewsController@index')->name('news');
        Route::post('/news/create', 'Api\Admin\NewsController@store')->name('news.create');
        Route::get('/news/{news}', 'Api\Admin\NewsController@show')->name('news.show');
        Route::patch('/news/{news}', 'Api\Admin\NewsController@update')->name('news.update');
        Route::delete('/news/{news}', 'Api\Admin\NewsController@delete')->name('news.delete');

        Route::get('/tableau', 'Api\Admin\TableauController@index')->name('tableau');
        Route::post('/tableau/create', 'Api\Admin\TableauController@store')->name('tableau.create');
        Route::get('/tableau/{tableau}', 'Api\Admin\TableauController@show')->name('tableau.show');
        Route::patch('/tableau/{tableau}', 'Api\Admin\TableauController@update')->name('tableau.update');
        Route::delete('/tableau/{tableau}', 'Api\Admin\TableauController@delete')->name('tableau.delete');

        Route::post('/files/upload', 'Api\Admin\FileUploadController@upload')->name('file.upload');
        Route::delete('/files/delete/{id}', 'Api\Admin\FileUploadController@uploadDelete')->name('file.delete');
    });
});

// Not Found Exception
Route::any('/{any?}', function () {
    throw new \App\Exceptions\Api\ApiNotFoundException();
})->where('any', '.*')->name('api.admin.notfound');
