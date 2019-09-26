<?php

// JWT Auth routes

Route::prefix('auth')
    ->group(base_path('routes/api/v1/auth.php'));

// Callbacks routes
Route::prefix('callback')
    ->group(base_path('routes/api/v1/callbacks.php'));

// Profile routes
Route::prefix('/')
    ->middleware(['auth:api'])
    ->group(base_path('routes/api/v1/profile.php'));

// Guest middleware routes
Route::group(['middleware' => 'guest:api'], function() {

});

// Not Found Exception
Route::any('/{any?}', function () {
    throw new \App\Exceptions\Api\ApiNotFoundException();
})->where('any', '.*')->name('api.v1.notfound');
