<?php
/**
 * Created by black40x@yandex.ru
 * Date: 04/09/2019
 */

namespace App\Actions\Users;

use App\Actions\BaseAction;
use App\Exceptions\Api\ApiException;
use App\Http\Requests\Api\v1\Callback\ReceivePinCodeRequest;
use App\Models\User;

class UpdatePinCodeAction extends BaseAction
{

    public function execute(ReceivePinCodeRequest $request, ?User $user)
    {
        if (!$user) {
            $user = new User([
                'ad_login' => $request->ad_login,
                'tab_no' => $request->tab_no,
                'id_person' => $request->id_phperson,
            ]);
            $user->save();
        }

        $user->pinCode()->updateOrCreate(
            [
                'user_id' => $user->id
            ],
            [
                'pin_code' => $request->pin_code,
                'created_at' => $request->created_at,
            ]
        );

        $this->setActionResult(true);

        return $this;
    }

}
