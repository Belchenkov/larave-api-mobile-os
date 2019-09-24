<?php
/**
 * Created by black40x@yandex.ru
 * Date: 05/09/2019
 */

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Api\v1\AuthorizationController@logout');
    Route::get('me', 'Api\v1\AuthorizationController@me');
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Api\v1\AuthorizationController@loginJwt');
    Route::post('refresh', 'Api\v1\AuthorizationController@refreshJwt');
});

