<?php

namespace App\Http\Controllers\Api\Admin;

use App\Exceptions\Api\ApiException;
use App\Http\Resources\Api\v1\ApprovalTask\ApprovalTask;
use App\Http\Resources\Api\v1\Statistic\UserVisits;
use App\Http\Resources\Api\v1\User\UserCatalog;
use App\Http\Resources\Api\v1\User\UserProfile;
use App\Models\Transit\Portal\ForUser;
use App\Models\User;
use App\Models\UserOption;
use App\Repositories\ApprovalTaskRepository;
use App\Repositories\User\StatisticVisitRepository;
use App\Repositories\User\UserRepository;
use Carbon\Carbon;
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

        $users = $userRepository->getUserCatalog($request->get('search'), $ids);

        return UserCatalog::collection(
            $request->get('page') == -1
            ? $users->get()
            : $users->paginate(15)->appends([
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
        // Add current day for debug information
        if (!$previous) $previous = Carbon::now()->addDays(1)->endOfDay()->timestamp;

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

    public function getUserApprovalTasks(Request $request, ApprovalTaskRepository $approvalTaskRepository, $id_phperson)
    {
        if (!$user = ForUser::where('id_phperson', $id_phperson)->first()) {
            throw new ApiException(404, 'User not found.');
        }

        return ApprovalTask::collection(
          $approvalTaskRepository->getUserTasks($user)->get()
        );
    }

    public function getSettingsForUser(Request $request, $id_phperson)
    {
        if (!$userOptions = UserOption::where('id_phperson', $id_phperson)->first()) {
            throw new ApiException(404, 'User options not found.');
        }
        return $this->apiSuccess($userOptions);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     * Change checkbox - Show to KIP
     */
    public function showKipChange(Request $request)
    {
        $this->validate($request, [
            'id_phperson' => 'required|max:100',
            'show_kip' => 'required'
        ]);

        UserOption::updateOrCreate(
            [
                'id_phperson' => $request->input('id_phperson')
            ],
            [
                'kip_global' => (int) $request->input('show_kip')
            ]
        )->touch();

        return $this->apiSuccess();
    }

}
