<?php
/**
 * Created by black40x@yandex.ru
 * Date: 05/09/2019
 */

Route::post('login', 'Api\v1\AuthorizationController@loginJwt');
Route::post('refresh', 'Api\v1\AuthorizationController@refreshJwt');
