<?php
/**
 * Created by black40x@yandex.ru
 * Date: 04/09/2019
 */

namespace App\Actions\Auth;

use App\Actions\BaseAction;
use App\Exceptions\Api\ApiException;
use App\Models\User;
use App\Models\UserDevice;
use Carbon\Carbon;

class LoginUserAction extends BaseAction
{
    /**
     * @var User
     */
    private $user = null;

    /**
     * @param $email
     * @param $pin_code
     * @param null $id_device
     * @return $this
     * Login User
     */
    public function execute($email, $pin_code, $id_device = null)
    {
        if ($user = User::where('email', $email)->first()) {
            if ($user->pinCode && $user->pinCode->pin_code == $pin_code
                && ($user->portalUser && $user->portalUser->out_date == null)
                && (Carbon::now()->timestamp - Carbon::parse($user->pinCode->updated_at)->timestamp < config('workflow.pin.life_time'))) {
                $this->user = $user;

                $jwtToken = $this->user->generateJwt();
                $user->pinCode->delete();
                $this->user->save();

                if ($id_device) {
                    UserDevice::where('device_id', $id_device)->delete();

                    $this->user->devices()->updateOrCreate(
                        [
                            'device_id' => $id_device
                        ],
                        [
                            'user_id' => $user->id,
                            'device_id' => $id_device,
                            'session_id' => $jwtToken->id
                        ]
                    )->touch();
                }

                $this->setActionResult($jwtToken);
            } else
                throw new ApiException(422, 'Invalid pin code');
        } else {
            throw new ApiException(422, 'User not found');
        }

        return $this;
    }
}
