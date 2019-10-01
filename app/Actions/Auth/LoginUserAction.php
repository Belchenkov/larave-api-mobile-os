<?php
/**
 * Created by black40x@yandex.ru
 * Date: 04/09/2019
 */

namespace App\Actions\Auth;

use App\Actions\BaseAction;
use App\Exceptions\Api\ApiException;
use App\Models\User;
use Carbon\Carbon;

class LoginUserAction extends BaseAction
{
    /**
     * @var User
     */
    private $user = null;

    public function execute($login, $pin_code, $id_device)
    {
        if ($user = User::where('ad_login', $login)->first()) {
            if ($user->pinCode && $user->pinCode->pin_code == $pin_code
                && Carbon::now()->diffInSeconds(Carbon::parse($user->pinCode->created_at)) < config('workflow.life_time,life_time')) {
                $this->user = $user;
                $this->user->id_device = $id_device;
                $this->user->save();
                $jwtToken = $this->user->generateJwt();

                $user->pinCode->delete();

                $this->setActionResult($jwtToken);
            } else
                throw new ApiException(422, 'Invalid pin code');
        } else {
            throw new ApiException(422, 'User not found');
        }

        return $this;
    }
}
