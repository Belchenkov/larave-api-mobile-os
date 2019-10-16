<?php
/**
 * Created by black40x@yandex.ru
 * Date: 04/09/2019
 */

namespace App\Actions\Users;

use App\Actions\BaseAction;
use App\Exceptions\Api\ApiException;
use App\Models\Transit\Portal\ForUser;
use App\Models\User;

class UpdatePinCodeAction extends BaseAction
{

    /**
     * @param $ad_login
     * @param $tab_no
     * @param $id_person
     * @param $pin_code
     * @param $created_at
     * @param User|null $user
     * @return $this
     * Update Pin-code from Portal
     */
    public function execute($ad_login, $tab_no, $id_person, $pin_code, $created_at, ?User $user)
    {
        // Check real user data
        if (!$real = ForUser::where('id_phperson', $id_person)->first())
            throw new ApiException(404, 'User not found.');

        if (!$real->email)
            throw new ApiException(422, 'User have not email.');

        if ($real->user_ad_login <> $ad_login)
            throw new ApiException(422, 'User data not valid.');

        if (!$user) {
            $user = new User([
                'ad_login' => trim($ad_login),
                'tab_no' => trim($tab_no),
                'id_person' => trim($id_person),
                'email' => $real->email
            ]);
            $user->save();
        }

        $user->pinCode()->updateOrCreate(
            [
                'user_id' => $user->id
            ],
            [
                'pin_code' => trim($pin_code),
                'created_at' => $created_at,
            ]
        )->touch();

        $this->setActionResult(true);

        return $this;
    }

}
