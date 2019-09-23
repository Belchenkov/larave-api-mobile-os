<?php

//Route::get('/', 'Api\v1\TestController@index');

// JWT Auth routes
use App\Models\Transit\SprDev;
use App\Models\Transit\TransitSkudEvent;

Route::prefix('auth')
    ->group(base_path('routes/api/v1/auth.php'));

// Callbacks routes
Route::prefix('callback')
    ->group(base_path('routes/api/v1/callbacks.php'));

// Profile routes
Route::prefix('profile')
    ->group(base_path('routes/api/v1/profile.php'));

// Auth middleware routes
Route::group(
    ['middleware' => 'guest:api'],
    function() {
    Route::get('test', function() {
        dd(\Auth::user());
    });
});

// Not Found Exception
Route::any('/{any?}', function () {
    throw new \App\Exceptions\Api\ApiNotFoundException();
})->where('any', '.*')->name('api.v1.notfound');
