<?php

//Route::get('/', 'Api\v1\TestController@index');

Route::group(['prefix' => 'callback'], function () {
    Route::post('pin/update', 'Api\v1\Callbacks\PinCodeController@receivePinCode');
});

// Not Found Exception
Route::any('/{any?}', function () {
    throw new \App\Exceptions\Api\ApiNotFoundException();
})->where('any', '.*')->name('api.v1.notfound');
