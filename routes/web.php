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

use App\Http\Resources\Api\v1\ApprovalTask\ApprovalTasks;
use App\Models\User;
use App\Repositories\ApprovalTaskRepository;

Route::get('/', function () {
    return response()->json([
        'result' => true,
        'data' => 'Welcome to GKOsnova Mobile Server'
    ]);
});

Route::get('/download/{doc_id}', 'Api\v1\ApprovalTaskController@downloadDocument')->name('downloadDocument');
