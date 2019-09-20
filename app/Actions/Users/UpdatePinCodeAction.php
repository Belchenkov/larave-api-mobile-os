<?php
/**
 * Created by black40x@yandex.ru
 * Date: 04/09/2019
 */

namespace App\Actions\Users;

use App\Actions\BaseAction;
use App\Exceptions\Api\ApiException;
use App\Models\Transit\CoreUserData;
use App\Models\User;

class UpdatePinCodeAction extends BaseAction
{

    public function execute($ad_login, $tab_no, $id_person, $pin_code, $created_at, ?User $user)
    {
        // Check real user data
        if (!CoreUserData::where('tab_no', $tab_no)->first()) {
            throw new ApiException(404, 'User not found.');
        }

        if (!$user) {
            $user = new User([
                'ad_login' => trim($ad_login),
                'tab_no' => trim($tab_no),
                'id_person' => trim($id_person),
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
        );

        $this->setActionResult(true);

        return $this;
    }

}
