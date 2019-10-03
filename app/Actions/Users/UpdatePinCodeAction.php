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
use App\Models\UserPinCode;

class UpdatePinCodeAction extends BaseAction
{

    public function execute($ad_login, $tab_no, $id_person, $pin_code, $created_at, ?User $user)
    {
        // Check real user data
        if (!$real = CoreUserData::where('tab_no', $tab_no)->first()) {
            throw new ApiException(404, 'User not found.');
        }

        // Check real all variables
        if ($real->SamAccountName <> $ad_login || $real->id_phperson <> $id_person)
            throw new ApiException(422, 'User data not valid.');

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
        )->touch();

        $this->setActionResult(true);

        return $this;
    }

}
