<?php
/**
 * Created by black40x@yandex.ru
 * Date: 05/09/2019
 */

Route::group(
    [
        'middleware' => 'auth:api',
        'as' => 'auth.',
    ],
    function () {
    Route::get('session/list', 'Api\v1\AuthorizationController@sessionsList')->name('session.list');
    Route::post('session/clear', 'Api\v1\AuthorizationController@sessionClear')->name('session.clear');
    Route::delete('session/delete/{session_id}', 'Api\v1\AuthorizationController@sessionDelete')->name('session.delete');

    Route::post('logout', 'Api\v1\AuthorizationController@logout')->name('logout');
    Route::get('me', 'Api\v1\AuthorizationController@me')->name('me');
});

Route::group([
    'middleware' => 'guest:api',
    'as' => 'auth.'
], function () {
    Route::post('login', 'Api\v1\AuthorizationController@loginJwt')->name('login');
    Route::post('refresh', 'Api\v1\AuthorizationController@refreshJwt')->name('refresh');
});

