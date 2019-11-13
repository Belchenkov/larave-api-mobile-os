<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\Support\RequestSupportAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Support\SupportRequest;
use Illuminate\Support\Facades\Auth;

class RequestSupportController extends Controller
{
    /**
     * @param SupportRequest $request
     * @param RequestSupportAction $action
     * @return RequestSupportAction
     */
    public function send(SupportRequest $request, RequestSupportAction $action)
    {
        return $action->execute(
            Auth::user()->portalUser,
            $request->comment,
            $request->type_request
        );
    }
}
