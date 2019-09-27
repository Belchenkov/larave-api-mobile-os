<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use App\Repositories\User\UserRepository;

Route::get('/', function () {
    return response()->json([
        'result' => true,
        'data' => 'Welcome to GKOsnova Mobile Server'
    ]);
});
