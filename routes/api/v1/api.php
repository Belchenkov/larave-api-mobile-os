<?php

//Route::get('/', 'Api\v1\TestController@index');

// JWT Auth routes
Route::prefix('auth')
    ->group(base_path('routes/api/v1/auth.php'));

// Callbacks routes
Route::prefix('callback')
    ->group(base_path('routes/api/v1/callbacks.php'));

// Profile routes
Route::prefix('profile')
    ->group(base_path('routes/api/v1/profile.php'));

// Statistics Visit routes
Route::prefix('statistic-visit')
    ->group(base_path('routes/api/v1/statisticsVisit.php'));

// Auth middleware routes
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('test', function() {
        dd(\Auth::user());
    });
});

// Not Found Exception
Route::any('/{any?}', function () {
    throw new \App\Exceptions\Api\ApiNotFoundException();
})->where('any', '.*')->name('api.v1.notfound');
