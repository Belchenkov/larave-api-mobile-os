<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\Auth\LoginUserAction;
use App\Actions\Auth\LogoutUserAction;
use App\Actions\Auth\RefreshUserAction;
use App\Http\Requests\Api\v1\Auth\LoginRequest;
use App\Http\Requests\Api\v1\Auth\LogoutRequest;
use App\Http\Requests\Api\v1\Auth\RefreshRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\User;
use App\Http\Resources\Api\v1\UserJwtToken;
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
            $action->execute($request)->getActionResult()
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
            $action->execute($request)->getActionResult()
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
        return $action->execute($request)->apiSuccess();
    }

    /**
     * @return User
     * Info about User
     */
    public function me()
    {
        return new User(Auth::user());
    }
}