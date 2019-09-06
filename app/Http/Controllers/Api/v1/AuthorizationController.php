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
use App\Http\Resources\JsonApiTrait;
use Illuminate\Support\Facades\Auth;

class AuthorizationController extends Controller
{

    /**
     * @param LoginRequest $request
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
     * @return JsonApiTrait
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
