<?php

namespace App\Http\Controllers\Api\v1\Callbacks;

use App\Actions\Users\UpdatePinCodeAction;
use App\Http\Requests\Api\v1\Callback\ReceivePinCodeRequest;
use App\Http\Controllers\Controller;
use App\Models\User\User;

class PinCodeController extends Controller
{

    public function receivePinCode(ReceivePinCodeRequest $request, UpdatePinCodeAction $action)
    {
        return $action->execute($request,
            User::where('ad_login', $request->ad_login)->first()
        )->apiSuccess();
    }

}
