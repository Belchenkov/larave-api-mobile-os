<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\Api\ApiException;
use App\Http\Resources\Api\v1\Statistic\UserVisits;
use App\Http\Resources\Api\v1\User\UserCatalog;
use App\Http\Resources\Api\v1\User\UserProfile;
use App\Models\Transit\Portal\ForUser;
use App\Repositories\User\StatisticVisitRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserCatalogController extends Controller
{

    /**
     * @param Request $request
     * @param UserRepository $userRepository
     * @return mixed
     * Get Catalog of Users
     */
    public function getCatalog(Request $request, UserRepository $userRepository)
    {
        $ids = null;

        if ($request->get('my')) {
            $ids = Cache::remember(
                'user.catalog.my.ids.'.Auth::user()->id_person,
                config('cache.cache_time'),
                function () use ($userRepository) {
                    return $userRepository->getDepartmentsIdsByCollection(Auth::user()->portalUser->departmentChief);
                }
            );
        } else
            if ($request->get('dep')) {
                $ids = $userRepository->getDepartmentsIds($request->get('dep'));
            }

        return Cache::remember(
            'user.catalog.tree.'.
            ($request->get('my') ? 'my.' . Auth::user()->id_person : 'all.').
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

    /**
     * @param Request $request
     * @param UserRepository $userRepository
     * @param $id_phperson
     * @return mixed
     * Get User Profile by id_phperson
     */
    public function getUserProfile(Request $request, UserRepository $userRepository, $id_phperson)
    {
        return Cache::remember(
            'user.catalog.profile.'.$id_phperson,
            config('cache.cache_time'),
            function () use ($id_phperson, $userRepository) {
                if (!$user = $userRepository->getUserProfileByIdPerson($id_phperson)) {
                    throw new ApiException(404, 'User not found.');
                }
                return new UserProfile($user);
            }
        );
    }

    /**
     * @param Request $request
     * @param StatisticVisitRepository $statisticVisitRepository
     * @param $id_phperson
     * @return mixed
     * Get User Visit Statistic Info by id_phperson
     */
    public function getUserVisitInfo(Request $request, StatisticVisitRepository $statisticVisitRepository, $id_phperson)
    {
        $previous = (int) $request->get('previous');

        return Cache::remember(
            'user.catalog.visit.'.$id_phperson.'.'.$previous,
            config('cache.cache_time'),
            function () use ($id_phperson, $previous, $statisticVisitRepository) {
                if (!$user = ForUser::where('id_phperson', $id_phperson)->first()) {
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
