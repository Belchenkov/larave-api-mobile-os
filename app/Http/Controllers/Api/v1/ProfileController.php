<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Statistic\UserVisits;
use App\Http\Resources\Api\v1\User\UserBadges;
use App\Http\Resources\Api\v1\User\UserProfile;
use App\Repositories\BadgesRepository;
use App\Repositories\User\StatisticVisitRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
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
     * @param Request $request
     * @param UserRepository $userRepository
     * @param BadgesRepository $badgesRepository
     * @return mixed
     */
    public function getProfileInfo(Request $request, UserRepository $userRepository)
    {
        return Cache::remember(
            'user.profile.'.Auth::user()->id_person,
            config('cache.cache_time'),
            function () use ($userRepository) {
                return new UserProfile(
                    $userRepository->getUserProfileByIdPerson(Auth::user()->id_person)
                );
            }
        );
    }

    public function getBadges(Request $request, BadgesRepository $badgesRepository)
    {
        return new UserBadges(
            $badgesRepository->getUserBadges(Auth::user()->portalUser)
        );
    }

    /**
     * Get Statistic Visit User
     * @param Request $request
     * @param StatisticVisitRepository $statisticVisitRepository
     * @return UserVisits
     */
    public function getStatisticsVisitInfo(Request $request, StatisticVisitRepository $statisticVisitRepository)
    {
        $previous = (int) $request->get('previous');

        return Cache::remember(
            'user.profile.visits.'.Auth::user()->id_person.'.'.$previous,
            config('cache.cache_time'),
            function () use ($statisticVisitRepository, $previous) {
                return new UserVisits(
                    $statisticVisitRepository->getVisitStatistic(Auth::user()->portalUser, $previous)
                );
            }
        );
    }
}
