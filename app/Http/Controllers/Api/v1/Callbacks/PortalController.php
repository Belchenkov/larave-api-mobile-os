<?php

namespace App\Http\Controllers\Api\v1\Callbacks;

use App\Http\Requests\Api\v1\Callback\HandlePushEventRequest;
use App\Jobs\HandlePush\EventPushNotificateJob;
use App\Http\Controllers\Controller;

class PortalController extends Controller
{

    public function handlePushEvent(HandlePushEventRequest $request)
    {
        $this->dispatch(new EventPushNotificateJob($request->all([
            'data',
            'type',
            'title',
            'message',
            'users',
        ])));

        return $this->apiSuccess();
    }

}
