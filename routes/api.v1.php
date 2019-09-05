<?php

//Route::get('/', 'Api\v1\TestController@index');

// JWT Auth routes
Route::group(['prefix' => 'auth', 'middleware' => 'guest:api'], function() {
    Route::post('login', 'Api\v1\AuthorizationController@loginJwt');
    Route::post('refresh', 'Api\v1\AuthorizationController@refreshJwt');
});

// Callbacks routes
Route::group(['prefix' => 'callback'], function() {
    Route::post('pin/update', 'Api\v1\Callbacks\PinCodeController@receivePinCode');
});

// Auth middleware routes
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('test', function() {
        dd(Auth::user());
    });
});

// Not Found Exception
Route::any('/{any?}', function () {
    throw new \App\Exceptions\Api\ApiNotFoundException();
})->where('any', '.*')->name('api.v1.notfound');
