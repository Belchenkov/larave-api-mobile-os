<?php
/**
 * Created by black40x@yandex.ru
 * Date: 05/09/2019
 */

Route::post('pin/update', 'Api\v1\Callbacks\PinCodeController@receivePinCode')->name('callbacks.pin.update');
