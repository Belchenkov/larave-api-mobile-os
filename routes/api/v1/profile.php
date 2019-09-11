<?php

Route::group([
    'middleware' => 'auth:api'
], function () {
    Route::get('/', 'Api\v1\ProfileController@getProfileInfo');
});
