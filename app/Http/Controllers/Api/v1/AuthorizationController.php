<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\Auth\LoginUserAction;
use App\Actions\Auth\RefreshUserAction;
use App\Http\Requests\Api\v1\Auth\LoginRequest;
use App\Http\Requests\Api\v1\Auth\RefreshRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\UserJwtToken;

class AuthorizationController extends Controller
{

    public function loginJwt(LoginRequest $request)
    {
        return new UserJwtToken(
            app(LoginUserAction::class)
            ->execute($request)->getActionResult()
        );
    }

    public function refreshJwt(RefreshRequest $request)
    {
        return new UserJwtToken(
            app(RefreshUserAction::class)
                ->execute($request)->getActionResult()
        );
    }

}
