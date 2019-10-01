<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\Api\ApiException;
use App\Http\Resources\Api\v1\Statistic\UserVisits;
use App\Http\Resources\Api\v1\User\UserCatalog;
use App\Http\Resources\Api\v1\User\UserProfile;
use App\Models\Transit\_1C\Transit1cEmployee;
use App\Repositories\User\StatisticVisitRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserCatalogController extends Controller
{

    public function getCatalog(Request $request, UserRepository $userRepository)
    {
        $ids = null;

        if ($request->get('my')) {
            $ids = Cache::remember(
                'user.catalog.my.ids.'.Auth::user()->tab_no,
                config('cache.cache_time'),
                function () use ($userRepository) {
                    return $userRepository->getDepartmentsIdsByCollection(Auth::user()->departmentChief);
                }
            );
        } else
            if ($request->get('dep')) {
                $ids = collect($request->get('dep'));
            }

        return Cache::remember(
            'user.catalog.tree.'.
            ($request->get('my') ? 'my.' . Auth::user()->tab_no : 'all.').
            ($request->get('dep') ? 'dep.'.$request->get('dep').'.' : '').
            $request->get('page').'.'.$request->get('search'),
            config('cache.cache_time'),

            function () use ($request, $userRepository, $ids) {
                return UserCatalog::collection(
                    $userRepository->getUserCatalog($request->get('search'), $ids)
                        ->simplePaginate(50)->appends([
                            'search' => $request->get('search'),
                            'dep' => $request->get('dep'),
                        ])
                );
            }
        );
    }

    public function getUserProfile(Request $request, UserRepository $userRepository, $tab_no)
    {
        return Cache::remember(
            'user.catalog.profile.'.$tab_no,
            config('cache.cache_time'),
            function () use ($tab_no, $userRepository) {
                if (!$user = $userRepository->getUserProfileByTabNo($tab_no)) {
                    throw new ApiException(404, 'User not found.');
                }

                return new UserProfile($user);
            }
        );
    }

    public function getUserVisitInfo(Request $request, StatisticVisitRepository $statisticVisitRepository, $tab_no)
    {
        $previous = (int) $request->get('previous');

        return Cache::remember(
            'user.catalog.visit.'.$tab_no.'.'.$previous,
            config('cache.cache_time'),
            function () use ($tab_no, $previous, $statisticVisitRepository) {
                if (!$user = Transit1cEmployee::where('tab_no', $tab_no)->first()) {
                    throw new ApiException(404, 'User not found.');
                }

                return new UserVisits(
                    $statisticVisitRepository->getVisitStatistic(
                        $user,
                        $previous
                    )
                );
            }
        );
    }

}
