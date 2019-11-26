<?php
/**
 * Created by black40x@yandex.ru
 * Date: 05/09/2019
 */

Route::post('pin/update', 'Api\v1\Callbacks\PinCodeController@receivePinCode')->name('callbacks.pin.update');

Route::group(['prefix' => 'sessions', 'as' => 'callbacks.sessions.'], function () {
    Route::get('{id_phperson}', 'Api\Admin\AuthorizationController@showUserSessions')->name('list');
    Route::delete('{id_phperson}', 'Api\Admin\AuthorizationController@deleteUserSessions')->name('delete');
});

Route::group(['prefix' => 'portal/kip', 'as' => 'portal.kip.'], function () {
    Route::post('event', 'Api\v1\Callbacks\PortalController@handleKipEvent')->name('event');
});
