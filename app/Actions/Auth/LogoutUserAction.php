<?php

namespace App\Actions\Auth;


use App\Actions\BaseAction;
use App\Exceptions\Api\ApiException;
use App\Http\Requests\Api\v1\Auth\LogoutRequest;
use App\Models\UserJwtToken;
use Illuminate\Support\Facades\Auth;

/**
 * Class LogoutUserAction
 * @package App\Actions\Auth
 * Logout User
 */
class LogoutUserAction extends BaseAction
{
    /**
     * @var UserJwtToken
     */
    private $userJwtToken = null;

    public function execute(LogoutRequest $request)
    {
        if ($userJwtToken = UserJwtToken::where('user_id', Auth::user()->id)->first()) {
            $this->userJwtToken = $userJwtToken;

            if ($this->userJwtToken->delete()) {
                return $this->apiSuccess('Logout was successful');
            } else {
                throw new ApiException(500, 'Error delete JWT Token');
            }
        } else {
            throw new ApiException(422, 'User not found');
        }
    }
}
