<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Statistic\UserVisits;
use App\Http\Resources\Api\v1\User\UserProfile;
use App\Repositories\User\StatisticVisitRepository;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Api\v1
 * Profile info (Личная кадровая информация)
 */
class ProfileController extends Controller
{

    /**
     * Get Profile Info for Auth User
     *
     * @param Request $request
     * @return mixed
     */
    public function getProfileInfo(Request $request)
    {
        return Cache::remember('user.profile.'.Auth::user()->id, config('cache.cache_time'), function () {
            return new UserProfile(Auth::user()->load('phPerson', 'employee', 'department', 'employeeStatus', 'employeeChief'));
        });
    }

    /**
     * Get Statistic Visit User
     *
     * @param Request $request
     * @param StatisticVisitRepository $statisticVisitRepository
     * @return UserVisits
     */
    public function getStatisticsVisitInfo(Request $request, StatisticVisitRepository $statisticVisitRepository)
    {
        $previous = (int) $request->get('previous');

        return Cache::remember(
            'user.profile.visits.'.Auth::user()->id.'.'.$previous,
            config('cache.cache_time'),
            function () use ($statisticVisitRepository, $previous) {
                return new UserVisits(
                    $statisticVisitRepository->getVisitStatistic(Auth::user(), $previous)
                );
            }
        );
    }
}
