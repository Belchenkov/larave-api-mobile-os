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

use App\Http\Resources\Api\v1\User\UserCatalog;
use App\Models\Transit\_1C\Transit1cEmployee;
use App\Repositories\User\UserRepository;

Route::get('/', function () {
    return response()->json([
        'result' => true,
        'data' => 'Welcome to GKOsnova Mobile Server'
    ]);
});


Route::get('/test', function () {
    $userRepository = new UserRepository();
    //dd($userRepository->getUserCatalog()->limit(20)->get());
    return UserCatalog::collection(
        $userRepository->getUserCatalog(request()->get('search'))
            ->simplePaginate(50)->appends([
                'search' => request()->get('search')
            ])
    );
});
