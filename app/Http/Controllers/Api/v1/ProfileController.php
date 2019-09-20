<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\Api\v1\Profile\Profile;
use App\Repositories\User\StatisticVisitRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Api\v1
 * Profile info (Личная кадровая информация)
 */
class ProfileController
{

    /**
     * Get Profile Info for Auth User
     * @return mixed
     */
    public function getProfileInfo()
    {
        return Cache::remember('getProfileInfo', config('cache.cache_time'), function () {
            return new Profile(Auth::user()->load('phPerson', 'employee', 'department', 'employeeStatus', 'employeeChief'));
        });
    }

    /**
     * Get Statistic Visit User
     * @param StatisticVisitRepository $statisticVisitRepository
     * @return mixed
     */
    public function getStatisticsVisitInfo(StatisticVisitRepository $statisticVisitRepository)
    {
        return  Cache::remember('getStatisticsVisitInfo', config('cache.cache_time'),
            function () use ($statisticVisitRepository) {
                return $statisticVisitRepository->getVisitStatistic(
                    Auth::user(),
                    (int) Input::get('previous')
                );
       });
    }
}
