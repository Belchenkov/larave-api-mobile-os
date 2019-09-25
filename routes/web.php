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

use App\Http\Resources\Api\v1\Statistic\UserVisits;
use App\Http\Resources\Api\v1\User\UserCatalog;
use App\Http\Resources\Api\v1\User\UserProfile;
use App\Models\Transit\_1C\Transit1cEmployee;
use App\Models\User;
use App\Repositories\User\StatisticVisitRepository;

Route::get('/', function () {
    return response()->json([
        'result' => true,
        'data' => 'Welcome to GKOsnova Mobile Server'
    ]);
});

Route::get('/vs', function () {

    return new UserProfile(User::find(10002)->employee);

    return (new UserVisits(
        (new StatisticVisitRepository())->getVisitStatistic(User::find(10002))
    ));
});

Route::get('/test', function () {
    return UserCatalog::collection(
        Transit1cEmployee::with([
            'phPerson'
        ])
        ->whereNotNull('out_date')
        //->orderBy('')
        ->simplePaginate(50)
    );
});
