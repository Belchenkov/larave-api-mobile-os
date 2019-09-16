<?php

namespace App\Http\Controllers\Api\v1\Callbacks;

use App\Actions\Users\UpdatePinCodeAction;
use App\Http\Requests\Api\v1\Callback\ReceivePinCodeRequest;
use App\Http\Controllers\Controller;
use App\Models\User;

class PinCodeController extends Controller
{

    public function receivePinCode(ReceivePinCodeRequest $request, UpdatePinCodeAction $action)
    {
        return $action->execute(
            $request->ad_login,
            $request->tab_no,
            $request->id_phperson,
            $request->pin_code,
            $request->created_at,
            User::where('ad_login', $request->ad_login)->first()
        )->apiSuccess();
    }

}
