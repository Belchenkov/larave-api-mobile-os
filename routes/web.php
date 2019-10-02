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

Route::get('/test', function () {
    $u = User::find(10002);
    $r = new ApprovalTaskRepository();

    dd($r->getTask('bada0388-1b92-11e7-90ed-00155d0a0203'));

    //return new App\Http\Resources\Api\v1\ApprovalTask\ApprovalTask($r->getTask('bada0388-1b92-11e7-90ed-00155d0a0203'));

    //return  ApprovalTasks::collection($r->getUserTasks($u));
});
