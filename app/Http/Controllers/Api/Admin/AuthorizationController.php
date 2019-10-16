<?php

namespace App\Http\Controllers\Api\Admin;

use App\Actions\Auth\ClearUserSessionAction;
use App\Actions\Auth\LoginAdminAction;
use App\Actions\Auth\LogoutUserAction;
use App\Actions\Auth\RefreshUserAction;
use App\Http\Requests\Api\v1\Auth\LogoutRequest;
use App\Http\Requests\Api\v1\Auth\RefreshRequest;
use App\Http\Resources\Api\v1\User\UserJwtToken;
use App\Http\Resources\Api\v1\User\UserProfile;
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
}
