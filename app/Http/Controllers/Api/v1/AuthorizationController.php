<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\Auth\ClearUserSessionAction;
use App\Actions\Auth\DeleteUserSessionAction;
use App\Actions\Auth\LoginUserAction;
use App\Actions\Auth\LogoutUserAction;
use App\Actions\Auth\RefreshUserAction;
use App\Http\Requests\Api\v1\Auth\LoginRequest;
use App\Http\Requests\Api\v1\Auth\LogoutRequest;
use App\Http\Requests\Api\v1\Auth\RefreshRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\User\UserJwtToken;
use App\Http\Resources\Api\v1\User\UserSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorizationController extends Controller
{

    /**
     * @param LoginRequest $request
     * @param LoginUserAction $action
     * @return UserJwtToken
     * Login User
     */
    public function loginJwt(LoginRequest $request, LoginUserAction $action)
    {
        return new UserJwtToken(
            $action->execute($request->email, $request->pin_code, $request->id_device)->getActionResult()
        );
    }

    /**
     * @param RefreshRequest $request
     * @param RefreshUserAction $action
     * @return UserJwtToken
     * Refresh JWT Token
     */
    public function refreshJwt(RefreshRequest $request, RefreshUserAction $action)
    {
        return new UserJwtToken(
            $action->execute($request->refresh_token)->getActionResult()
        );
    }

    /**
     * @param LogoutRequest $request
     * @param LogoutUserAction $action
     * @return \Illuminate\Http\JsonResponse Logout User
     * Logout User
     */
    public function logout(LogoutRequest $request, LogoutUserAction $action)
    {
        return $action->execute(Auth::user(), $request->get('device_id', null))->apiSuccess();
    }

    /**
     * @param Request $request
     * @param ClearUserSessionAction $action
     * @return \Illuminate\Http\JsonResponse
     */
    public function sessionClear(Request $request, ClearUserSessionAction $action)
    {
        return $action->execute(Auth::user())->apiSuccess();
    }

    /**
     * @param Request $request
     * @param DeleteUserSessionAction $action
     * @return \Illuminate\Http\JsonResponse
     */
    public function sessionDelete(Request $request, DeleteUserSessionAction $action, $session_id)
    {
        return $action->execute(Auth::user(), $session_id)->apiSuccess();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sessionsList(Request $request)
    {
        return UserSession::collection(Auth()->user()->getSessionList());
    }

    /**
     * @return User
     * Info about User
     */
    public function me()
    {
        return Auth::user();
    }
}
