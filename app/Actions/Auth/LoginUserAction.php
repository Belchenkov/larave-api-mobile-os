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

    public function execute($email, $pin_code, $id_device = null)
    {
        if ($user = User::where('email', $email)->first()) {
            if ($user->pinCode && $user->pinCode->pin_code == $pin_code
                && Carbon::now()->diffInSeconds(Carbon::parse($user->pinCode->updated_at)) < config('workflow.pin.life_time')) {
                $this->user = $user;

                if ($id_device) {
                    $this->user->devices()->updateOrCreate(
                        [
                            'device_id' => $id_device
                        ],
                        [
                            'user_id' => $user->id,
                            'device_id' => $id_device,
                        ]
                    )->touch();
                }

                $jwtToken = $this->user->generateJwt();
                $user->pinCode->delete();
                $this->user->save();

                $this->setActionResult($jwtToken);
            } else
                throw new ApiException(422, 'Invalid pin code');
        } else {
            throw new ApiException(422, 'User not found');
        }

        return $this;
    }
}
