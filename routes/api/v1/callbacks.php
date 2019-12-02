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

Route::group(['prefix' => 'portal/push', 'as' => 'portal.push.'], function () {
    Route::post('events', 'Api\v1\Callbacks\PortalController@handlePushEvent')->name('events');
});
