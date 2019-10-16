<?php

namespace App\Http\Controllers\Api\Admin;

use App\Exceptions\Api\ApiException;
use App\Http\Resources\Api\v1\Statistic\UserVisits;
use App\Http\Resources\Api\v1\User\UserCatalog;
use App\Http\Resources\Api\v1\User\UserProfile;
use App\Models\Transit\Portal\ForUser;
use App\Repositories\User\StatisticVisitRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function getCatalog(Request $request, UserRepository $userRepository)
    {
        $ids = null;

        if ($request->get('dep')) {
            $ids = $userRepository->getDepartmentsIds($request->get('dep'));
        }

        return UserCatalog::collection(
            $userRepository->getUserCatalog($request->get('search'), $ids)
                ->paginate(15)->appends([
                    'search' => $request->get('search'),
                    'dep' => $request->get('dep'),
                ])
        );
    }

    public function getUserProfile(Request $request, UserRepository $userRepository, $id_phperson)
    {
        if (!$user = $userRepository->getUserProfileByIdPerson($id_phperson)) {
            throw new ApiException(404, 'User not found.');
        }

        return new UserProfile($user);
    }

    public function getUserVisitInfo(Request $request, StatisticVisitRepository $statisticVisitRepository, $id_phperson)
    {
        $previous = (int) $request->get('previous');

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
}
