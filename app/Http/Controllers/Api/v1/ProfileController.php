<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\User\UserProfile;
use App\Repositories\User\StatisticVisitRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Api\v1
 * Profile info (Личная кадровая информация)
 */
class ProfileController extends Controller
{

    /**
     * Get Profile Info for Auth User
     * @return mixed
     */
    public function getProfileInfo()
    {
        return Cache::remember('getProfileInfo', config('cache.cache_time'), function () {
            return new UserProfile(Auth::user()->load('phPerson', 'employee', 'department', 'employeeStatus', 'employeeChief'));
        });
    }

    /**
     * Get Statistic Visit User
     * @param StatisticVisitRepository $statisticVisitRepository
     * @return mixed
     */
    public function getStatisticsVisitInfo(StatisticVisitRepository $statisticVisitRepository)
    {
        $previous = (int) Input::get('previous');

        return $this->apiSuccess(
            Cache::remember(
                'getStatisticsVisitInfo.' . $previous,
                config('cache.cache_time'),
                function () use ($statisticVisitRepository, $previous) {
                    return $statisticVisitRepository->getVisitStatistic(
                        Auth::user(),
                        $previous
                    );
                }
            )
        );
    }
}
