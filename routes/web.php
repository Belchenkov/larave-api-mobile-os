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

use App\Repositories\ApprovalTaskRepository;

Route::get('/', function () {
    return response()->json([
        'result' => true,
        'data' => 'Welcome to GKOsnova Mobile Server'
    ]);
});

Route::get('/test', function () {
    $r = (new ApprovalTaskRepository())->getTask('f2d2ea69-05f0-11ea-9127-00155d504e24');
    return new App\Http\Resources\Api\v1\ApprovalTask\ApprovalTask($r);
});
