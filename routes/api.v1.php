<?php

Route::get('/', 'Api\v1\TestController@index');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('test', function() {
        dd(Auth::user());
    });
});

Route::group(['prefix' => 'auth', 'middleware' => 'guest'], function() {
    Route::post('login', 'Api\v1\AuthorizationController@loginJwt');
});

Route::group(['prefix' => 'callback'], function() {
    Route::post('pin/update', 'Api\v1\Callbacks\PinCodeController@receivePinCode');
});

// Not Found Exception
Route::any('/{any?}', function() {
    throw new \App\Exceptions\Api\ApiNotFoundException();
})->where('any', '.*')->name('api.v1.notfound');
