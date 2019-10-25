<?php

namespace App\Http\Controllers\Api\Admin;

use App\Actions\Auth\ClearUserSessionAction;
use App\Actions\Auth\LoginAdminAction;
use App\Actions\Auth\LogoutUserAction;
use App\Actions\Auth\RefreshUserAction;
use App\Exceptions\Api\ApiException;
use App\Http\Requests\Api\v1\Auth\LogoutRequest;
use App\Http\Requests\Api\v1\Auth\RefreshRequest;
use App\Http\Resources\Api\v1\User\UserJwtToken;
use App\Http\Resources\Api\v1\User\UserProfile;
use App\Models\User;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthorizationController extends Controller
{

    public function loginJwt(Request $request, LoginAdminAction $action)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        return new UserJwtToken($action->execute($request->email, $request->password)->getActionResult());
    }

    public function refreshJwt(RefreshRequest $request, RefreshUserAction $action)
    {
        return new UserJwtToken(
            $action->execute($request->refresh_token)->getActionResult()
        );
    }

    public function logout(LogoutRequest $request, LogoutUserAction $action)
    {
        return $action->execute(Auth::user())->apiSuccess();
    }

    public function profile(Request $request, UserRepository $userRepository)
    {
        return new UserProfile($userRepository->getUserProfileByIdPerson(Auth::user()->id_person));
    }

    public function sessionClear(Request $request, ClearUserSessionAction $action)
    {
        return $action->execute(Auth::user())->apiSuccess();
    }

    public function showUserSessions(Request $request, $id_phperson)
    {
        if (!$user = User::where('id_person', $id_phperson)->first())
            throw new ApiException(404, 'User not found.');

        return $this->apiSuccess(
            $user->jwtToken()->orderBy('created_at', 'DESC')->get(
                [
                    'id',
                    'user_agent',
                    'ip_address',
                    'access_expire_at',
                    'refresh_expire_at',
                    'created_at',
                    'updated_at'
                ]
            )
        );
    }

    public function deleteUserSessions(Request $request, $id_phperson)
    {
        if (!$user = User::where('id_person', $id_phperson)->first())
            throw new ApiException(404, 'User not found.');

        if ($request->get('session_id')) {
            $user->removeSessionById($request->get('session_id'));
            return $this->apiSuccess();
        } elseif ($request->get('all') == 1) {
            $user->removeAllSession();
            return $this->apiSuccess();
        } elseif ($request->get('others') == 1) {
            $user->removeOtherSession(request()->bearerToken());
            return $this->apiSuccess();
        }

        return $this->apiError('No action selected');
    }
}
